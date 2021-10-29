<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Club_league;
use App\Models\league;
use App\Models\Club;
use App\Models\Country;
use App\Models\Fixture;
use App\Models\Handicap;

class ArchivesController extends Controller
{
    //
    public function index_list($leagues_id)
    {        
        $data           = DB::table('fixtures as f')
                            ->join('clubs as ch', 'ch.id', '=', 'f.home_clubs_id')
                            ->join('clubs as ca', 'ca.id', '=', 'f.away_clubs_id')
                            ->select(
                                'f.id', 
                                'f.round_league', 

                                'ch.nama as ch_nama', 
                                'ca.nama as ca_nama',

                                'f.home_clubs_id', 
                                'f.away_clubs_id',
                                
                                'f.home_goals', 
                                'f.away_goals',

                                'f.home_corners', 
                                'f.away_corners',

                                'f.last_home_points', 
                                'f.last_away_points',

                                // 'f.prematch_total_avg_goals_as_home', 
                                // 'f.prematch_total_avg_goals_as_away',

                                // 'f.prematch_total_avg_corners_as_home', 
                                // 'f.prematch_total_avg_corners_as_away',

                                'f.home_hdp_goals', 
                                'f.away_hdp_goals',
                                
                                'f.over_under_goals', 

                                'f.home_hdp_corners', 
                                'f.away_hdp_corners',
                                
                                'f.over_under_corners', 

                                'f.min_corners', 
                                'f.max_corners',

                                DB::raw("(SELECT nama FROM bet_statuses WHERE id = f.my_bet) as my_bet"),

                                'f.bet_status',
                                // 'f.handicap_voor_goals_status',
                                // 'f.handicap_voor_corners_status',
                                
                                'f.over_goals_status',
                                'f.over_corners_status',

                                'f.home_yellow_cards', 
                                'f.away_yellow_cards',

                                'f.home_red_cards', 
                                'f.away_red_cards',

                                DB::raw("(SELECT corner_fav FROM club_leagues WHERE clubs_id = f.home_clubs_id and leagues_id = f.leagues_id) as home_corner_fav"),
                                DB::raw("(SELECT corner_fav FROM club_leagues WHERE clubs_id = f.away_clubs_id and leagues_id = f.leagues_id) as away_corner_fav"),

                                'f.akurasi', 
                                'f.notes',  
 
                                )
                            ->where('f.leagues_id', $leagues_id)
                            ->get();

        $league_model   = Country::join('leagues', 'leagues.countries_id', '=', 'countries.id')
                            ->select(
                                'leagues.id', 
                                'leagues.nama', 
                                'leagues.tahun',
                                'countries.id as countries_id',
                                'countries.nama as nama_countries')
                            ->where('leagues.id', $leagues_id)
                            ->first();

        $league_name    = $league_model->nama;
        $league_tahun   = $league_model->tahun;
        $country_name   = $league_model->nama_countries;
        $countries_id   = $league_model->countries_id;

        $content        = 'Fixtures';
        $panel_name     = $country_name.' : '.$league_name.' '.$league_tahun;

        return view('content.backend.'.strtolower($content).'.index_list', 
                compact(
                    'data', 
                    'panel_name', 
                    'content', 
                    'leagues_id',
                    'countries_id'
                ));
    }

    public function create($fixture_id)
    {
        $content    = 'Archives';
        $panel_name = ' Archives';

        $fixtures   = Fixture::find($fixture_id);

        $model_leagues   = League::find($fixtures->leagues_id);

        $leagues    = League::
                        join('leagues as LA', 'leagues.countries_id', '=', 'LA.countries_id')
                        ->join('fixtures as fix', 'fix.leagues_id', '=', 'LA.id')
                        ->select(
                            'leagues.id', 
                            'leagues.nama', 
                            'leagues.tahun')
                        ->where('fix.id', $fixture_id)
                        ->get();

        if($model_leagues->countries_id != 4)
        {
            $clubs    = Club::whereIn('id', [$fixtures->home_clubs_id, $fixtures->away_clubs_id])
                        ->get();
        }
        else
        {
            $clubs   = Club_league::join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->select(
                                    'clubs.id', 
                                    'clubs.nama')
                                ->where('club_leagues.leagues_id', $fixtures->leagues_id)
                                ->orderBy('nama')
                                ->get();
        }


        return  view('content.backend.'.strtolower($content).'.create', 
                compact(
                    'content', 
                    'panel_name', 
                    'leagues', 
                    'clubs'
                )
            );
    } 

    public function store(Request $request)
    {
        $content    = 'Fixtures';

        $this->validate($request, [
            'leagues_id'      => 'required',
            'raw_text'        => 'required',
        ]);
        
        $leagues_id     = $request->leagues_id;

        $edited_raw_text = str_replace(' ', '//', preg_replace('/\s+/', ' ', $request->raw_text));

        $str_replace_raw_text = $edited_raw_text;

        $model_flashscoretext = Flashscoretext::get();

        foreach($model_flashscoretext as $row)
        {
            $str_replace_raw_text = str_replace($row->nama, '', $str_replace_raw_text);
        }

        $data = Fixture::create([
            'leagues_id'          => $leagues_id,
            'raw_text'              => $edited_raw_text,
            //           
            'round_league'          => round_league($edited_raw_text, 'Round'),

            'home_clubs_id'      => club($edited_raw_text, 'Home', $leagues_id),
            'away_clubs_id'      => club($edited_raw_text, 'Away', $leagues_id),

            'home_goals'      => goals($edited_raw_text, 'Home'),
            'away_goals'      => goals($edited_raw_text, 'Away'),

            'home_ball_possession'      => ball_possession($edited_raw_text, 'Home'),
            'away_ball_possession'      => ball_possession($edited_raw_text, 'Away'),

            'home_goal_attempts'        => goal_attempts($edited_raw_text, 'Home'),
            'away_goal_attempts'        => goal_attempts($edited_raw_text, 'Away'),

            'home_shots_on_goals'       => shots_on_goal($edited_raw_text, 'Home'),
            'away_shots_on_goals'       => shots_on_goal($edited_raw_text, 'Away'),
            
            'home_shots_off_goals'      => shots_off_goal($edited_raw_text, 'Home'),
            'away_shots_off_goals'      => shots_off_goal($edited_raw_text, 'Away'),
            
            'home_blocked_shots'      => blocked_shots($edited_raw_text, 'Home'),
            'away_blocked_shots'      => blocked_shots($edited_raw_text, 'Away'),
            
            'home_free_kicks'           => free_kicks($edited_raw_text, 'Home'),
            'away_free_kicks'           => free_kicks($edited_raw_text, 'Away'),

            'home_corners'              => corner_kicks($edited_raw_text, 'Home'),
            'away_corners'              => corner_kicks($edited_raw_text, 'Away'),

            'home_offsides'              => offsides($edited_raw_text, 'Home'),
            'away_offsides'              => offsides($edited_raw_text, 'Away'),

            'home_throw_in'              => throw_in($edited_raw_text, 'Home'),
            'away_throw_in'              => throw_in($edited_raw_text, 'Away'),

            'home_goalkeeper_saves'              => goalkeeper_saves($edited_raw_text, 'Home'),
            'away_goalkeeper_saves'              => goalkeeper_saves($edited_raw_text, 'Away'),
            
            'home_red_cards'         => red_cards($edited_raw_text, 'Home'),
            'away_red_cards'         => red_cards($edited_raw_text, 'Away'),

            'home_yellow_cards'         => yellow_cards($edited_raw_text, 'Home'),
            'away_yellow_cards'         => yellow_cards($edited_raw_text, 'Away'),
            
            'home_tackles'              => tackles($edited_raw_text, 'Home'),
            'away_tackles'              => tackles($edited_raw_text, 'Away'),
            
            'home_attacks'              => attacks($edited_raw_text, 'Home'),
            'away_attacks'              => attacks($edited_raw_text, 'Away'),
            
            'home_fouls'                => fouls($edited_raw_text, 'Home'),
            'away_fouls'                => fouls($edited_raw_text, 'Away'),

            'home_total_passes'                => total_passes($edited_raw_text, 'Home'),
            'away_total_passes'                => total_passes($edited_raw_text, 'Away'),

            'home_completed_passes'                => completed_passes($edited_raw_text, 'Home'),
            'away_completed_passes'                => completed_passes($edited_raw_text, 'Away'),
            
            'home_dangerous_attacks'    => dangerous_attacks($edited_raw_text, 'Home'),
            'away_dangerous_attacks'    => dangerous_attacks($edited_raw_text, 'Away'),

            'post_raw_text' => $str_replace_raw_text,
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                //->route('Postmatch.edit', $data->id)
                ->route('Club_leagues.calibrate', $data->leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route($content.'.show', $request->leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    } 

    /*
        backup


    public function store(Request $request)
    {
        $content    = 'Fixtures';

        $this->validate($request, [
            'leagues_id'      => 'required',
            'round_league'    => 'required',

            'home_clubs_id'    => 'required',
            'away_clubs_id'    => 'required',
        ]);

        $data = Fixture::create([
            'leagues_id'                => $request->leagues_id,
            'round_league'              => $request->round_league,

            'home_clubs_id'             => $request->home_clubs_id,
            'away_clubs_id'             => $request->away_clubs_id,

            'home_goals'                => $request->home_goals,
            'away_goals'                => $request->away_goals,

            'home_corners'              => $request->home_corners,
            'away_corners'              => $request->away_corners,

            'home_ball_possession'      => $request->home_ball_possession,
            'away_ball_possession'      => $request->away_ball_possession,

            'home_goal_attempts'        => $request->home_goal_attempts,
            'away_goal_attempts'        => $request->away_goal_attempts,

            'home_shots_on_goals'       => $request->home_shots_on_goals,
            'away_shots_on_goals'       => $request->away_shots_on_goals,
            
            'home_shots_off_goals'      => $request->home_shots_off_goals,
            'away_shots_off_goals'      => $request->away_shots_off_goals,
            
            'home_free_kicks'           => $request->home_free_kicks,
            'away_free_kicks'           => $request->away_free_kicks,
            
            'home_yellow_cards'         => $request->home_yellow_cards,
            'away_yellow_cards'         => $request->away_yellow_cards,
            
            'home_tackles'              => $request->home_tackles,
            'away_tackles'              => $request->away_tackles,
            
            'home_attacks'              => $request->home_attacks,
            'away_attacks'              => $request->away_attacks,
            
            'home_fouls'                => $request->home_fouls,
            'away_fouls'                => $request->away_fouls,
            
            'home_dangerous_attacks'    => $request->home_dangerous_attacks,
            'away_dangerous_attacks'    => $request->away_dangerous_attacks,

        ]);

        if($data)
        {            
            /* Club league 
                Check home and away
            //*/
                /*
                $home_check = Club_league::where('leagues_id', $request->leagues_id)
                                            ->where('clubs_id', $request->home_clubs_id)
                                            ->first();
                //dd($home_check);

                    if(!is_countable($home_check))
                    {
                        Club_league::create([
                            'leagues_id'        => $request->]
                            leagues_id,
                            'clubs_id'          => $request->home_clubs_id
                        ]);
                    }

                $away_check = Club_league::where('leagues_id', $request->leagues_id)
                                            ->where('clubs_id', $request->away_clubs_id)
                                            ->first();

                    if(!is_countable($away_check))
                    {
                        Club_league::create([
                            'leagues_id'        => $request->leagues_id,
                            'clubs_id'          => $request->away_clubs_id
                        ]);
                    }
                    //

            // Club league 
                Club_league::Postmatch($request->leagues_id, $request->home_clubs_id);
                Club_league::Postmatch($request->leagues_id, $request->away_clubs_id);

            /* Club 
                Club::Postmatch($request->home_clubs_id);
                Club::Postmatch($request->away_clubs_id);     

            ///*
                $Betstatus = Fixture::findOrFail($data->id);
                
                    $handicap_voor_goals_status     = Fixture::bet_status($data->id, 'handicap_voor_goals_status');
                    $handicap_voor_corners_status   = Fixture::bet_status($data->id, 'handicap_voor_corners_status');

                    $over_goals_status              = Fixture::bet_status($data->id, 'over_goals_status');
                    $over_corners_status            = Fixture::bet_status($data->id, 'over_corners_status');

                    $bet_status                     = Fixture::bet_status($data->id, 'bet_status');

                    $home_win                     = Fixture::bet_status($data->id, 'home_win');            
                    $away_win                     = Fixture::bet_status($data->id, 'away_win');

                    $home_win_handicap_goals                     = Fixture::bet_status($data->id, 'home_win_handicap_goals');            
                    $away_win_handicap_goals                     = Fixture::bet_status($data->id, 'away_win_handicap_goals');

                    $over_goals                     = Fixture::bet_status($data->id, 'over_goals');            
                    $under_goals                     = Fixture::bet_status($data->id, 'under_goals');

                    $home_win_corners                     = Fixture::bet_status($data->id, 'home_win_corners');            
                    $away_win_corners                     = Fixture::bet_status($data->id, 'away_win_corners');

                    $home_win_handicap_corners                     = Fixture::bet_status($data->id, 'home_win_handicap_corners');            
                    $away_win_handicap_corners                     = Fixture::bet_status($data->id, 'away_win_handicap_corners');

                    $over_corners                     = Fixture::bet_status($data->id, 'over_corners');            
                    $under_corners                     = Fixture::bet_status($data->id, 'under_corners');

                $Betstatus->update([
                    'handicap_voor_goals_status'    => $handicap_voor_goals_status,
                    'handicap_voor_corners_status'  => $handicap_voor_corners_status,

                    'over_goals_status'             => $over_goals_status,
                    'over_corners_status'           => $over_corners_status,

                    'bet_status'                    => $bet_status,

                    'home_win'                      => $home_win,
                    'away_win'                      => $away_win,

                    'home_win_handicap_goals'        => $home_win_handicap_goals,
                    'away_win_handicap_goals'        => $away_win_handicap_goals,

                    'over_goals'                     => $over_goals,
                    'under_goals'                    => $under_goals,

                    'home_win_corners'               => $home_win_corners,
                    'away_win_corners'               => $away_win_corners,

                    'home_win_handicap_corners'      => $home_win_handicap_corners,
                    'away_win_handicap_corners'      => $away_win_handicap_corners,
                    
                    'over_corners'                   => $over_corners,
                    'under_corners'                  => $under_corners,
                ]); 
            //   
            
            //redirect dengan pesan sukses
                return redirect()
                    ->route($content.'.index_list', $request->leagues_id)
                    ->with(['success' => 'Data Berhasil Disimpan!']);
        }
        else
        {
            //redirect dengan pesan error
                return redirect()
                    ->route($content.'.show', $request->leagues_id)
                    ->with(['error' => 'Data Gagal Disimpan!']);
        }
    } 
    */
}
