<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\Team_league;
use App\Models\League;
use App\Models\Team;
use App\Models\Country;
use App\Models\History;


class PrematchesController extends Controller
{

    public function create($leagues_id)
    {
        $content        = 'Brazil';

        $leagues_id     = $leagues_id;

        $league_model   = League::where('id', $leagues_id)->first();
            $league_name    = $league_model->nama;
            $league_year    = $league_model->tahun;

        $teams          = Team_league::join('teams', 'teams.id', '=', 'team_leagues.teams_id')
                            ->select('teams.id', 'teams.nama')
                            ->where('team_leagues.leagues_id', $leagues_id)
                            ->orderby('nama','asc')
                            ->get();

        $handicap = array(
                        '0', '0.25', '0.5', '0.75',
                        '1', '1.25', '1.5', '1.75',
                        '2', '2.25', '2.5', '2.75',
                        '3', '3.25', '3.5', '3.75',
                    );

        $over_under = array('1.75',
                        '2', '2.25', '2.5', '2.75',
                        '3', '3.25', '3.5', '3.75',
                    );

        $over_under_corner  = array(
                        '6', '7', '8', '9', '10', '11', '12', '13'
                    );

        $handicap_corner = array(
                        '8.5', '9.5', '10.5', '11.5', '12.5'
                    );

        $country_model   = Country::where('id', $league_model->countries_id)->first();
            $country_name    = $country_model->nama;

        return view('content.backend.prematches.create', 
                compact(
                    'content',
                    'leagues_id',
                    'league_name',
                    'league_year',
                    'handicap', 
                    'over_under', 
                    'handicap_corner', 
                    'over_under_corner', 
                    'country_name', 
                    'teams'
                    )
            );
    }

    public function store(Request $request)
    {
        $leagues_id         = $request->leagues_id;
        $countries_id       = League::where('id', $leagues_id)->value('countries_id');


        $countries_name       = Country::where('id', $countries_id)->value('nama');
        /*
        $this->validate($request, [
            'leagues_id'        => 'required',
            'league_round'      => 'required',

            'home_teams_id'     => 'required',
            'away_teams_id'     => 'required',

            'home_score'        => 'required',
            'away_score'        => 'required',

            'home_corner'       => 'required',
            'away_corner'       => 'required'
        ]);
        */

        $home_avg_goals = History::where('leagues_id', $request->leagues_id)
                            ->where('teams_id', $request->home_teams_id)
                            ->avg('goals');

        $home_avg_corners = History::where('leagues_id', $request->leagues_id)
                            ->where('teams_id', $request->home_teams_id)
                            ->avg('corners');

        $away_avg_goals = History::where('leagues_id', $request->leagues_id)
                            ->where('teams_id', $request->away_teams_id)
                            ->avg('goals');

        $away_avg_corners = History::where('leagues_id', $request->leagues_id)
                            ->where('teams_id', $request->away_teams_id)
                            ->avg('corners');

        $data = Statistic::create([
            'leagues_id'        => $request->leagues_id,
            'round_league'      => $request->round_league,

            'home_teams_id'     => $request->home_teams_id,
            'away_teams_id'     => $request->away_teams_id,

            'home_hdp_goals'        => $request->home_hdp_goals,
            'away_hdp_goals'        => $request->away_hdp_goals,

            'home_hdp_corners'       => $request->home_hdp_corners,
            'away_hdp_corners'       => $request->away_hdp_corners,

            'min_corners'       => $request->min_corners,
            'max_corners'       => $request->max_corners,

            'over_under_goals'       => $request->over_under_goals,
            'over_under_corners'       => $request->over_under_corners,


            'home_avg_goals'       => $home_avg_goals,
            'away_avg_goals'       => $away_avg_goals,

            'home_avg_corners'       => $home_avg_corners,
            'away_avg_corners'       => $away_avg_corners
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                ->route('Statistics.show', $leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route('Statistics.show', $leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
}
