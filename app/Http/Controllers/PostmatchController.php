<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Club_league;
use App\Models\league;
use App\Models\Club;
use App\Models\Country;
use App\Models\Fixture;

class PostmatchController extends Controller
{
    //
    public function edit(Fixture $Postmatch)
    {
        $content    = 'Postmatch';
        $panel_name = 'Postmatch';

        $model_leagues   = League::find($Postmatch->leagues_id);
        
        if($model_leagues->countries_id != 4)
        {
            $club       = league::join('countries', 'countries.id', '=', 'leagues.countries_id')
                        ->join('clubs', 'clubs.countries_id', '=', 'countries.id')
                            ->select(
                                'clubs.id', 
                                'clubs.nama')
                            ->where('leagues.id', $Postmatch->leagues_id)
                            ->orderBy('nama')
                            ->get();
        }
        else
        {
            $club   = Club_league::join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->select(
                                    'clubs.id', 
                                    'clubs.nama')
                                ->where('club_leagues.leagues_id', $Postmatch->leagues_id)
                                ->orderBy('nama')
                                ->get();
        }

        
        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'Postmatch',
                    'club'
                )
            );
    }

    public function update(Request $request, Fixture $Postmatch)
    {
        $content    = 'Postmatch';

        $this->validate($request, [
            'home_goals'              => 'required',
            'away_goals'              => 'required',

            'home_corners'            => 'required',
            'away_corners'            => 'required',
        ]);

        $Postmatch = Fixture::findOrFail($Postmatch->id);
        
        //dd($Postmatch);
        //
        $home_goals = $request->home_goals;
        $away_goals = $request->away_goals;

            $home_status = Fixture::match_status($home_goals, $away_goals,'home');
                // dd($home_status);
            $away_status = Fixture::match_status($home_goals, $away_goals,'away');
                // dd($away_status);

        $Postmatch->update([
            'home_goals'                => $home_goals,
            'away_goals'                => $away_goals,

            'home_corners'              => $request->home_corners,
            'away_corners'              => $request->away_corners,

            'home_status'               => $home_status,
            'away_status'               => $away_status,
            
            //           
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

        if($Postmatch)
        {            
            /* Club league */
                Club_league::Postmatch($Postmatch->leagues_id, $Postmatch->home_clubs_id);
                Club_league::Postmatch($Postmatch->leagues_id, $Postmatch->away_clubs_id);

            /* Club */
                Club::Postmatch($Postmatch->home_clubs_id);
                Club::Postmatch($Postmatch->away_clubs_id); 

            ///*
                $Betstatus = Fixture::findOrFail($Postmatch->id);
                    // $handicap_voor_goals_status     = Fixture::bet_status($Postmatch->id, 'handicap_voor_goals_status');
                    // $handicap_voor_corners_status   = Fixture::bet_status($Postmatch->id, 'handicap_voor_corners_status');

                    $over_goals_status              = Fixture::bet_status($Postmatch->id, 'over_goals_status');
                    $over_corners_status            = Fixture::bet_status($Postmatch->id, 'over_corners_status');

                    $bet_status                     = Fixture::bet_status($Postmatch->id, 'bet_status');

                    $home_win                     = Fixture::bet_status($Postmatch->id, 'home_win');            
                    $away_win                     = Fixture::bet_status($Postmatch->id, 'away_win');

                    $home_win_handicap_goals                     = Fixture::bet_status($Postmatch->id, 'home_win_handicap_goals');            
                    $away_win_handicap_goals                     = Fixture::bet_status($Postmatch->id, 'away_win_handicap_goals');

                    $over_goals                     = Fixture::bet_status($Postmatch->id, 'over_goals');            
                    $under_goals                     = Fixture::bet_status($Postmatch->id, 'under_goals');

                    $home_win_corners                     = Fixture::bet_status($Postmatch->id, 'home_win_corners');            
                    $away_win_corners                     = Fixture::bet_status($Postmatch->id, 'away_win_corners');

                    $home_win_handicap_corners                     = Fixture::bet_status($Postmatch->id, 'home_win_handicap_corners');            
                    $away_win_handicap_corners                     = Fixture::bet_status($Postmatch->id, 'away_win_handicap_corners');

                    $over_corners                     = Fixture::bet_status($Postmatch->id, 'over_corners');            
                    $under_corners                     = Fixture::bet_status($Postmatch->id, 'under_corners');

                $Betstatus->update([
                    // 'handicap_voor_goals_status'    => $handicap_voor_goals_status,
                    // 'handicap_voor_corners_status'  => $handicap_voor_corners_status,

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
            //*/

            //redirect dengan pesan sukses
            return redirect()
                ->route('Fixtures.index_list', $Postmatch->leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route('Fixtures.show', $Postmatch->leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /*
        calibrate postmatch
            total_avg_home_goals
            total_avg_away_goals
            total_avg_home_corners
            total_avg_away_corners

    */
    public function re()
    {

    }
}
