<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club_league;
use App\Models\league;
use App\Models\Club;
use App\Models\Country;
use App\Models\Fixture;

class Club_leaguesController extends Controller
{
    //
    public function index_list($leagues_id)
    {
        $data           = Club_league::
                            join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->select(
                                'club_leagues.id', 
                                'clubs.nama', 
                                // 'club_leagues.total_avg_home_goals', 
                                // 'club_leagues.total_avg_away_goals', 
                                // 'club_leagues.total_avg_home_corners', 
                                // 'club_leagues.total_avg_away_corners', 
                                'club_leagues.goals_home_min',
                                'club_leagues.goals_home_avg',
                                'club_leagues.goals_home_max',
                                'club_leagues.goals_away_min',
                                'club_leagues.goals_away_avg',
                                'club_leagues.goals_away_max',
                                'club_leagues.corners_home_min',
                                'club_leagues.corners_home_avg',
                                'club_leagues.corners_home_max',
                                'club_leagues.corners_away_min',
                                'club_leagues.corners_away_avg',
                                'club_leagues.corners_away_max',

                                'club_leagues.yellow_cards_home_min',
                                'club_leagues.yellow_cards_home_avg',
                                'club_leagues.yellow_cards_home_max',
                                'club_leagues.yellow_cards_away_min',
                                'club_leagues.yellow_cards_away_avg',
                                'club_leagues.yellow_cards_away_max',

                                'club_leagues.red_cards_home_min',
                                'club_leagues.red_cards_home_avg',
                                'club_leagues.red_cards_home_max',
                                'club_leagues.red_cards_away_min',
                                'club_leagues.red_cards_away_avg',
                                'club_leagues.red_cards_away_max',

                                'club_leagues.home_corner_club',
                                'club_leagues.away_corner_club',
                                'club_leagues.points')
                            ->where('club_leagues.leagues_id', $leagues_id)
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



        $content        = 'Club_leagues';
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

    public function corner_stats($leagues_id)
    {
        $data           = Club_league::
                            join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->select(
                                'club_leagues.id', 
                                'clubs.nama', 
                                // 'club_leagues.total_avg_home_goals', 
                                // 'club_leagues.total_avg_away_goals', 
                                // 'club_leagues.total_avg_home_corners', 
                                // 'club_leagues.total_avg_away_corners', 
                                'club_leagues.goals_home_min',
                                'club_leagues.goals_home_avg',
                                'club_leagues.goals_home_max',
                                'club_leagues.goals_away_min',
                                'club_leagues.goals_away_avg',
                                'club_leagues.goals_away_max',
                                'club_leagues.corners_home_min',
                                'club_leagues.corners_home_avg',
                                'club_leagues.corners_home_max',
                                'club_leagues.corners_away_min',
                                'club_leagues.corners_away_avg',
                                'club_leagues.corners_away_max',

                                'club_leagues.yellow_cards_home_min',
                                'club_leagues.yellow_cards_home_avg',
                                'club_leagues.yellow_cards_home_max',
                                'club_leagues.yellow_cards_away_min',
                                'club_leagues.yellow_cards_away_avg',
                                'club_leagues.yellow_cards_away_max',

                                'club_leagues.red_cards_home_min',
                                'club_leagues.red_cards_home_avg',
                                'club_leagues.red_cards_home_max',
                                'club_leagues.red_cards_away_min',
                                'club_leagues.red_cards_away_avg',
                                'club_leagues.red_cards_away_max',

                                'club_leagues.home_corner_club',
                                'club_leagues.away_corner_club',
                                'club_leagues.points')
                            ->where('club_leagues.leagues_id', $leagues_id)
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

        $content        = 'Club_leagues';
        $panel_name     = $country_name.' : '.$league_name.' '.$league_tahun;

        return view('content.backend.'.strtolower($content).'.corner_stats', 
                compact(
                    'data', 
                    'panel_name', 
                    'content', 
                    'leagues_id',
                    'countries_id'
                ));
    }

    public function corner_wdl($leagues_id)
    {
        $data           = Club_league::
                            join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->select(
                                'club_leagues.id', 
                                'clubs.nama', 
                                


                                'club_leagues.home_win_corners',
                                'club_leagues.home_draw_corners',
                                'club_leagues.home_lose_corners',

                                'club_leagues.away_win_corners',
                                'club_leagues.away_draw_corners',
                                'club_leagues.away_lose_corners',

                                'club_leagues.home_corner_club',
                                'club_leagues.away_corner_club',
                                'club_leagues.points')
                            ->where('club_leagues.leagues_id', $leagues_id)
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

        $content        = 'Club_leagues';
        $panel_name     = $country_name.' : '.$league_name.' '.$league_tahun;

        return view('content.backend.'.strtolower($content).'.corner_wdl', 
                compact(
                    'data', 
                    'panel_name', 
                    'content', 
                    'leagues_id',
                    'countries_id'
                ));
    }
    public function card_stats($leagues_id)
    {
        $data           = Club_league::
                            join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->select(
                                'club_leagues.id', 
                                'clubs.nama', 
                                // 'club_leagues.total_avg_home_goals', 
                                // 'club_leagues.total_avg_away_goals', 
                                // 'club_leagues.total_avg_home_corners', 
                                // 'club_leagues.total_avg_away_corners', 
                                'club_leagues.goals_home_min',
                                'club_leagues.goals_home_avg',
                                'club_leagues.goals_home_max',
                                'club_leagues.goals_away_min',
                                'club_leagues.goals_away_avg',
                                'club_leagues.goals_away_max',
                                'club_leagues.corners_home_min',
                                'club_leagues.corners_home_avg',
                                'club_leagues.corners_home_max',
                                'club_leagues.corners_away_min',
                                'club_leagues.corners_away_avg',
                                'club_leagues.corners_away_max',

                                'club_leagues.yellow_cards_home_min',
                                'club_leagues.yellow_cards_home_avg',
                                'club_leagues.yellow_cards_home_max',
                                'club_leagues.yellow_cards_away_min',
                                'club_leagues.yellow_cards_away_avg',
                                'club_leagues.yellow_cards_away_max',

                                'club_leagues.red_cards_home_min',
                                'club_leagues.red_cards_home_avg',
                                'club_leagues.red_cards_home_max',
                                'club_leagues.red_cards_away_min',
                                'club_leagues.red_cards_away_avg',
                                'club_leagues.red_cards_away_max',
                                
                                'club_leagues.home_corner_club',
                                'club_leagues.away_corner_club',
                                'club_leagues.points')
                            ->where('club_leagues.leagues_id', $leagues_id)
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

        $content        = 'Club_leagues';
        $panel_name     = $country_name.' : '.$league_name.' '.$league_tahun;

        return view('content.backend.'.strtolower($content).'.card_stats', 
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
        $content    = 'Club_leagues';
        $panel_name = ' Club_leagues';

        $not_club = Club_league::select('clubs_id')->where('leagues_id',$leagues_id);

        $country = League::findOrFail($leagues_id);

        if($country->countries_id != 4) 
        {
            $club       = league::join('countries', 'countries.id', '=', 'leagues.countries_id')
                            ->join('clubs', 'clubs.countries_id', '=', 'countries.id')
                                ->select(
                                    'clubs.id', 
                                    'clubs.nama')
                                ->where('leagues.id', $leagues_id)
                                ->whereNotIn('clubs.id', $not_club)
                                ->orderBy('nama')
                                ->get();
        }
        else            
        {
            $club   = Club::select(
                                    'clubs.id', 
                                    'clubs.nama')
                                ->whereNotIn('clubs.id', $not_club)
                                ->orderBy('nama')
                                ->get();
        }

        return  view('content.backend.'.strtolower($content).'.create', 
                compact(
                    'content', 
                    'panel_name',
                    'leagues_id',
                    'club'
                )
            );
    }

    public function store(Request $request)
    {
        $content    = 'Club_leagues';

        $this->validate($request, [
            'clubs_id'      => 'required',
            'leagues_id'    => 'required'
        ]);

        $data = Club_league::create([
            'clubs_id'      => $request->clubs_id,
            'leagues_id'    => $request->leagues_id
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

    public function edit(Club_league $Club_league)
    {
        $content    = 'Club_leagues';
        $panel_name = ' Club_leagues';

        $model = Club_league::join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->join('leagues', 'leagues.id', '=', 'club_leagues.leagues_id')
                            ->select('clubs.nama as clubs_name',
                                    'leagues.nama as leagues_name',
                                    'leagues.tahun')
                            ->where('club_leagues.id', $Club_league->id)
                            ->first();
        
        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'Club_league',
                    'model'
                )
            );
    }

    public function update(Request $request, Club_league $Club_league)
    {
        $content    = 'Club_leagues';
        $panel_name = ' Club_leagues';


        $Club_league = Club_league::findOrFail($Club_league->id);

        $Club_league->update([
            'corner_fav'              => $request->corner_fav,
        ]);

        if($Club_league)
        {
            return redirect()
                ->route($content.'.index_list', $Club_league->leagues_id)
                ->with(['Success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()
                ->route($content.'.index_list', $Club_league->leagues_id)
                ->with(['Error' => 'Data Gagal Disimpan!']);
        }
    }
    
    public function calibrate($leagues_id)
    {
        $content    = 'Club_leagues';

        $model      = Club_league::where('leagues_id', $leagues_id)
                            ->get();

        foreach ($model as $row) 
        {
            $update_model = Club_league::where('leagues_id', $leagues_id)
                                ->where('clubs_id', $row->clubs_id)
                                ->first();

            $goals_home_min             = Fixture::min_max($leagues_id, $row->clubs_id, 'home', 'home_goals', 'Min');
            $goals_home_avg             = Fixture::avg_me($leagues_id, $row->clubs_id, 'home', 'home_goals');
            $goals_home_max             = Fixture::min_max($leagues_id, $row->clubs_id, 'home', 'home_goals', 'Max');
            
            $goals_away_min             = Fixture::min_max($leagues_id, $row->clubs_id, 'away', 'away_goals', 'Min');
            $goals_away_avg             = Fixture::avg_me($leagues_id, $row->clubs_id, 'away', 'away_goals');
            $goals_away_max             = Fixture::min_max($leagues_id, $row->clubs_id, 'away', 'away_goals', 'Max');
            
            $corners_home_min           = Fixture::min_max($leagues_id, $row->clubs_id, 'home', 'home_corners', 'Min');
            $corners_home_avg           = Fixture::avg_me($leagues_id, $row->clubs_id, 'home', 'home_corners');
            $corners_home_max           = Fixture::min_max($leagues_id, $row->clubs_id, 'home', 'home_corners', 'Max');
            
            $corners_away_min           = Fixture::min_max($leagues_id, $row->clubs_id, 'away', 'away_corners', 'Min');
            $corners_away_avg           = Fixture::avg_me($leagues_id, $row->clubs_id, 'away', 'away_corners');
            $corners_away_max           = Fixture::min_max($leagues_id, $row->clubs_id, 'away', 'away_corners', 'Max');
            
            $yellow_cards_home_min       = Fixture::min_max($leagues_id, $row->clubs_id, 'home', 'home_yellow_cards', 'Min');
            $yellow_cards_home_avg       = Fixture::avg_me($leagues_id, $row->clubs_id, 'home', 'home_yellow_cards');
            $yellow_cards_home_max       = Fixture::min_max($leagues_id, $row->clubs_id, 'home', 'home_yellow_cards', 'Max');
            
            $yellow_cards_away_min       = Fixture::min_max($leagues_id, $row->clubs_id, 'away', 'away_yellow_cards', 'Min');
            $yellow_cards_away_avg       = Fixture::avg_me($leagues_id, $row->clubs_id, 'away', 'away_yellow_cards');
            $yellow_cards_away_max       = Fixture::min_max($leagues_id, $row->clubs_id, 'away', 'away_yellow_cards', 'Max');
            
            $red_cards_home_min       = Fixture::min_max($leagues_id, $row->clubs_id, 'home', 'home_red_cards', 'Min');
            $red_cards_home_avg       = Fixture::avg_me($leagues_id, $row->clubs_id, 'home', 'home_red_cards');
            $red_cards_home_max       = Fixture::min_max($leagues_id, $row->clubs_id, 'home', 'home_red_cards', 'Max');
            
            $red_cards_away_min       = Fixture::min_max($leagues_id, $row->clubs_id, 'away', 'away_red_cards', 'Min');
            $red_cards_away_avg       = Fixture::avg_me($leagues_id, $row->clubs_id, 'away', 'away_red_cards');
            $red_cards_away_max       = Fixture::min_max($leagues_id, $row->clubs_id, 'away', 'away_red_cards', 'Max');

            $home_corner_club           = Fixture::corner_club($leagues_id, $row->clubs_id, 'home');
            $away_corner_club           = Fixture::corner_club($leagues_id, $row->clubs_id, 'away');

            $home_win_corners           = Fixture::count_wdl($leagues_id, $row->clubs_id, 'home', 'home_wdl_corners', 'Win');
            $home_draw_corners          = Fixture::count_wdl($leagues_id, $row->clubs_id, 'home', 'home_wdl_corners', 'Draw');
            $home_lose_corners          = Fixture::count_wdl($leagues_id, $row->clubs_id, 'home', 'home_wdl_corners', 'Lose');

            $away_win_corners           = Fixture::count_wdl($leagues_id, $row->clubs_id, 'away', 'away_wdl_corners', 'Win');
            $away_draw_corners          = Fixture::count_wdl($leagues_id, $row->clubs_id, 'away', 'away_wdl_corners', 'Draw');
            $away_lose_corners          = Fixture::count_wdl($leagues_id, $row->clubs_id, 'away', 'away_wdl_corners', 'Lose');

            $points                     = Fixture::total_points($leagues_id, $row->clubs_id);

            $update_model->update([
                'goals_home_min'        => $goals_home_min,
                'goals_home_avg'        => $goals_home_avg,
                'goals_home_max'        => $goals_home_max,
                'goals_away_min'        => $goals_away_min,
                'goals_away_avg'        => $goals_away_avg,
                'goals_away_max'        => $goals_away_max,
                
                'corners_home_min'      => $corners_home_min,
                'corners_home_avg'      => $corners_home_avg,
                'corners_home_max'      => $corners_home_max,
                'corners_away_min'      => $corners_away_min,
                'corners_away_avg'      => $corners_away_avg,
                'corners_away_max'      => $corners_away_max,

                'yellow_cards_home_min'  => $yellow_cards_home_min,
                'yellow_cards_home_avg'  => $yellow_cards_home_avg,
                'yellow_cards_home_max'  => $yellow_cards_home_max,
                'yellow_cards_away_min'  => $yellow_cards_away_min,
                'yellow_cards_away_avg'  => $yellow_cards_away_avg,
                'yellow_cards_away_max'  => $yellow_cards_away_max,
                
                'red_cards_home_min'  => $red_cards_home_min,
                'red_cards_home_avg'  => $red_cards_home_avg,
                'red_cards_home_max'  => $red_cards_home_max,
                'red_cards_away_min'  => $red_cards_away_min,
                'red_cards_away_avg'  => $red_cards_away_avg,
                'red_cards_away_max'  => $red_cards_away_max,

                'home_corner_club'      => $home_corner_club,
                'away_corner_club'      => $away_corner_club,

                'home_win_corners'      => $home_win_corners,
                'home_draw_corners'     => $home_draw_corners,
                'home_lose_corners'     => $home_lose_corners,

                'away_win_corners'      => $away_win_corners,
                'away_draw_corners'     => $away_draw_corners,
                'away_lose_corners'     => $away_lose_corners,

                'points'                => $points,
            ]);

        }


        return redirect()
            ->route($content.'.index_list', $leagues_id)
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
