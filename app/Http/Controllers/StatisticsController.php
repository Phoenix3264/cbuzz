<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\Team_league;
use App\Models\Country;
use App\Models\League;
use Illuminate\Support\Facades\DB;


class StatisticsController extends Controller
{
    public function show($leagues_id)
    {
        $countries_id   = League::where('id', $leagues_id)->value('countries_id');

        $content        = Country::where('id', $countries_id)->value('nama');

        $data           = DB::table('statistics as S')
                            ->join('teams as HT', 'HT.id', '=', 's.home_teams_id')
                            ->join('teams as AT', 'AT.id', '=', 's.away_teams_id')
                            ->select(
                                's.id', 
                                's.round_league', 

                                'HT.nama as HT_nama', 
                                'AT.nama as AT_nama',

                                's.home_hdp_goals', 
                                's.away_hdp_goals',

                                's.over_under_goals', 

                                's.home_avg_goals', 
                                's.away_avg_goals',

                                's.home_goals', 
                                's.away_goals',

                                's.home_hdp_corners', 
                                's.away_hdp_corners',

                                's.over_under_corners', 

                                's.home_avg_corners', 
                                's.away_avg_corners',

                                's.home_corners', 
                                's.away_corners',
 
                                )
                            ->where('s.leagues_id', $leagues_id)
                            ->get();

        $teams          = Team_league::join('teams', 'teams.id', '=', 'team_leagues.teams_id')
                            ->select('teams.id', 'teams.nama')
                            ->where('team_leagues.leagues_id', $leagues_id)
                            ->get();

        $panel_name = 'Statistic '.$content.' Leagues';

        return view('content.backend.statistic.data', 
            compact(
                    'data', 
                    'teams', 
                    'content', 
                    'panel_name',
                    'leagues_id'
                ));
    }

    public function create($league_id)
    {
        $content    = 'Brazil';
        return view('content.backend.leagues.create', compact('content'));
    }
}
