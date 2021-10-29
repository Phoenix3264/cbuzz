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

class FixturesController extends Controller
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
                            ->whereNull('home_goals')
                            ->whereNull('away_goals')
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

    public function create($leagues_id)
    {
        $content    = 'Fixtures';
        $panel_name = ' Fixtures';

        $country = League::findOrFail($leagues_id);

        if($country->countries_id != 4) 
        {
            $club       = league::join('countries', 'countries.id', '=', 'leagues.countries_id')
                            ->join('clubs', 'clubs.countries_id', '=', 'countries.id')
                                ->select(
                                    'clubs.id', 
                                    'clubs.nama')
                                ->where('leagues.id', $leagues_id)
                                ->orderBy('nama')
                                ->get();
        }
        else            
        {
            $club   = Club_league::join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->select(
                                    'clubs.id', 
                                    'clubs.nama')
                                ->where('club_leagues.leagues_id', $leagues_id)
                                ->orderBy('nama')
                                ->get();
        }

        $handicap_goals   = Handicap::where('nama','<',6)
                                        ->get();

        $ou_corners = Handicap::where('nama','>',7)
                                        ->get();

        return  view('content.backend.'.strtolower($content).'.create', 
                compact(
                    'content', 
                    'panel_name',
                    'leagues_id',
                    'club',
                    'handicap_goals',
                    'ou_corners'
                )
            );
    }    

    public function store(Request $request)
    {
        $content    = 'Fixtures';

        $this->validate($request, [
            'leagues_id'      => 'required',
            'round_league'    => 'required',

            'home_clubs_id'    => 'required',
            'away_clubs_id'    => 'required',
        ]);
        
        $leagues_id     = $request->leagues_id;

        $home_clubs_id  = $request->home_clubs_id;
        $away_clubs_id  = $request->away_clubs_id;
        
        $last_home_points = Club_league::row_me($leagues_id, $home_clubs_id, 'points');
        $last_away_points = Club_league::row_me($leagues_id, $away_clubs_id, 'points');

        // $prematch_total_avg_goals_as_home = Club_league::row_me($leagues_id, $home_clubs_id, 'total_avg_home_goals');
        // $prematch_total_avg_goals_as_away = Club_league::row_me($leagues_id, $away_clubs_id, 'total_avg_away_goals');
        
        // $prematch_total_avg_corners_as_home   = Club_league::row_me($leagues_id, $home_clubs_id, 'total_avg_home_corners');
        // $prematch_total_avg_corners_as_away   = Club_league::row_me($leagues_id, $away_clubs_id, 'total_avg_away_corners');

        $data = Fixture::create([
            'leagues_id'      => $leagues_id,
            'round_league'    => $request->round_league,

            'home_clubs_id'    => $home_clubs_id,
            'away_clubs_id'    => $away_clubs_id,

            'home_hdp_goals'    => $request->home_hdp_goals,
            'away_hdp_goals'    => $request->away_hdp_goals,

            'over_under_goals'    => $request->over_under_goals,

            'home_hdp_corners'    => $request->home_hdp_corners,
            'away_hdp_corners'    => $request->away_hdp_corners,

            'over_under_corners'    => $request->over_under_corners,

            'last_home_points'      => $last_home_points,
            'last_away_points'      => $last_away_points,
            
            // 'prematch_total_avg_goals_as_home'    => $prematch_total_avg_goals_as_home,
            // 'prematch_total_avg_goals_as_away'    => $prematch_total_avg_goals_as_away,
            
            // 'prematch_total_avg_corners_as_home'    => $prematch_total_avg_corners_as_home,
            // 'prematch_total_avg_corners_as_away'    => $prematch_total_avg_corners_as_away,
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                ->route($content.'.index_list', $request->leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route($content.'.show', $request->leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }    

    public function edit(Fixture $Fixture)
    {
        $content    = 'Fixtures';
        $panel_name = 'Fixtures';
        /*
        $club       = league::join('countries', 'countries.id', '=', 'leagues.countries_id')
                        ->join('clubs', 'clubs.countries_id', '=', 'countries.id')
                            ->select(
                                'clubs.id', 
                                'clubs.nama')
                            ->where('leagues.id', $Fixture->leagues_id)
                            ->orderBy('nama')
                            ->get();        
                            */

        $club   = Club_league::join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                    ->select(
                            'clubs.id', 
                            'clubs.nama')
                        ->where('club_leagues.leagues_id', $Fixture->leagues_id)
                        ->orderBy('nama')
                        ->get();

        $handicap_goals   = Handicap::where('nama','<',6)
                                        ->get();

        $ou_corners = Handicap::where('nama','>',7)
                                        ->get();
        
        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'Fixture',
                    'club',
                    'handicap_goals',
                    'ou_corners'
                )
            );
    }

    public function update(Request $request, Fixture $Fixture)
    {
        $content    = 'Fixtures';


        $Fixture = Fixture::findOrFail($Fixture->id);

        if($request->home_hdp_goals == '')
        {
            $home_hdp_goals = Null;
        }
        if($request->away_hdp_goals == '')
        {
            $away_hdp_goals = Null;
        }
        if($request->over_under_goals == '')
        {
            $over_under_goals = Null;
        }
        if($request->home_hdp_corners == '')
        {
            $home_hdp_corners = Null;
        }
        if($request->away_hdp_corners == '')
        {
            $away_hdp_corners = Null;
        }
        if($request->over_under_corners == '')
        {
            $over_under_corners = Null;
        }


        $Fixture->update([
            'leagues_id'      => $request->leagues_id,
            'round_league'    => $request->round_league,

            'home_clubs_id'    => $request->home_clubs_id,
            'away_clubs_id'    => $request->away_clubs_id,

            'home_hdp_goals'    => $request->home_hdp_goals,
            'away_hdp_goals'    => $request->away_hdp_goals,

            'over_under_goals'    => $request->over_under_goals,

            'home_hdp_corners'    => $request->home_hdp_corners,
            'away_hdp_corners'    => $request->away_hdp_corners,

            'over_under_corners'    => $request->over_under_corners,

            'min_corners'    => $request->min_corners,
            'max_corners'    => $request->max_corners,
        ]);

        if($Fixture){
            //redirect dengan pesan sukses
            return redirect()
                ->route($content.'.index_list', $request->leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route($content.'.show', $request->leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function calibrate($leagues_id)
    {       
        $content    = 'Fixtures';
        $panel_name = ' Fixtures';

        $model_fixture = Fixture::where('leagues_id', '=', $leagues_id)
                            ->orderBy('round_league')
                            ->get();

        foreach($model_fixture as $row)
        {
            Fixture::update_calibrate($row->id);
        }


        return redirect()
            ->route($content.'.index_list', $leagues_id)
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
