<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fixture;
use App\Models\bet_status;
use App\Models\bet_accuracy;
use App\Models\Club_league;
use App\Models\Club;

class CornerkickController extends Controller
{
    //
    public function index()
    {        
        $data           = DB::table('fixtures as f')
                            ->join('clubs as ch', 'ch.id', '=', 'f.home_clubs_id')
                            ->join('clubs as ca', 'ca.id', '=', 'f.away_clubs_id')
                            ->join('bet_statuses as bs', 'bs.id', '=', 'f.my_bet')
                            ->join('leagues as l', 'l.id', '=', 'f.leagues_id')
                            ->select(
                                'f.id', 
                                'f.leagues_id', 
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

                                'f.home_hdp_goals', 
                                'f.away_hdp_goals',
                                
                                'f.over_under_goals', 

                                'f.home_hdp_corners', 
                                'f.away_hdp_corners',
                                
                                'f.min_corners', 
                                'f.max_corners',

                                DB::raw("(SELECT corner_fav FROM club_leagues WHERE clubs_id = f.home_clubs_id and leagues_id = f.leagues_id) as home_corner_fav"),
                                DB::raw("(SELECT corner_fav FROM club_leagues WHERE clubs_id = f.away_clubs_id and leagues_id = f.leagues_id) as away_corner_fav"),

                                'f.over_under_corners',  
                                'bs.nama as my_bet',  
                                'l.nama as league_name', 
                                'f.akurasi', 
                                'f.notes',  
                                )
                                ->whereNotNull('my_bet')
                                ->whereNull('home_goals')
                                ->whereNull('away_goals')
                                ->whereIn('my_bet', [7,8,9,10,11,12,13,14])
                            ->get();

        $content        = 'Cornerkick';
        $panel_name     = 'Cornerkick';

        return view('content.backend.'.strtolower($content).'.index', 
                compact(
                    'data', 
                    'panel_name', 
                    'content'
                ));
    }



    public function edit(Fixture $Cornerkick)
    {
        $content    = 'Cornerkick';
        $panel_name = 'Cornerkick';
        
        $bet_status     = bet_status::
                            orderBy('nama')
                            ->get();

        $bet_corner_status     = bet_status::
                            orderBy('nama')
                            ->whereIn('id', [7,8,9,10,11,12,13,14])
                            ->get();

        $bet_accuracy   = bet_accuracy::get();

        $fixture        = fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                            ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')                            
                            ->join("club_leagues as clh", function($joinh){
                                $joinh->on("clh.clubs_id", "=", "ch.id")
                                    ->on("clh.leagues_id", "=", "fixtures.leagues_id");
                            })
                            ->join("club_leagues as cla", function($joina){
                                $joina->on("cla.clubs_id", "=", "ca.id")
                                    ->on("cla.leagues_id", "=", "fixtures.leagues_id");
                            })
                                ->select( 
                                    'ch.nama as home_club',
                                    'ca.nama as away_club',

                                    'clh.points as home_points',
                                    'cla.points as away_points',
                                    
                                    'fixtures.home_clubs_id', 
                                    'fixtures.away_clubs_id',
                                    
                                    'fixtures.id',
                                
                                    // 'clh.total_avg_home_goals',
                                    // 'cla.total_avg_away_goals',
                                    
                                    // 'clh.total_avg_home_corners',
                                    // 'cla.total_avg_away_corners',
                                    
                                    'clh.home_corner_club',
                                    'cla.away_corner_club',

                                    'fixtures.home_hdp_goals',
                                    'fixtures.away_hdp_goals',

                                    'fixtures.home_hdp_corners',
                                    'fixtures.away_hdp_corners',

                                    'fixtures.over_under_goals',
                                    'fixtures.over_under_corners',
                                    )
                                ->where('fixtures.id', $Cornerkick->id)
                                ->first();
        
        $home_data_1    = fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                        ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                            
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$Cornerkick->home_clubs_id)
                                            ->where('fixtures.leagues_id',$Cornerkick->leagues_id);

        
        
        $htoh_1         = fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                        ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                            
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun as tahun_liga',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$Cornerkick->home_clubs_id)
                                            ->where('fixtures.away_clubs_id',$Cornerkick->away_clubs_id);

        $htoh_data      = fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                    ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')        
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                                   
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun as tahun_liga',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$Cornerkick->away_clubs_id)
                                            ->where('fixtures.away_clubs_id',$Cornerkick->home_clubs_id)
                                            ->union($htoh_1)
                                            ->orderBy('tahun_liga','Desc')
                                            ->orderBy('round_league','Desc')
                                            ->get();       

        $home_ss        = Club_league::join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                                    ->join('leagues', 'leagues.id', '=', 'club_leagues.leagues_id')
                                    ->select(
                                        'leagues.nama as leagues',
                                        'leagues.tahun as tahun',
                                        'clubs.nama as club',
                                        // 'club_leagues.total_avg_home_goals',
                                        // 'club_leagues.total_avg_away_goals',
                                        // 'club_leagues.total_avg_home_corners',
                                        // 'club_leagues.total_avg_away_corners',
                                        'club_leagues.home_corner_club',
                                        'club_leagues.away_corner_club',
                                        'club_leagues.points'
                                    )
                                    ->where('club_leagues.clubs_id', $Cornerkick->home_clubs_id)
                                    ->get();   

        $away_ss        = Club_league::join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                                    ->join('leagues', 'leagues.id', '=', 'club_leagues.leagues_id')
                                    ->select(
                                        'leagues.nama as leagues',
                                        'leagues.tahun as tahun',
                                        'clubs.nama as club',
                                        // 'club_leagues.total_avg_home_goals',
                                        // 'club_leagues.total_avg_away_goals',
                                        // 'club_leagues.total_avg_home_corners',
                                        // 'club_leagues.total_avg_away_corners',
                                        'club_leagues.home_corner_club',
                                        'club_leagues.away_corner_club',
                                        'club_leagues.points'
                                    )
                                    ->where('club_leagues.clubs_id', $Cornerkick->away_clubs_id)
                                    ->get();

        $clubs          = Club::select(
                                        'clubs.nama as club',
                                        // 'clubs.total_avg_home_goals',
                                        // 'clubs.total_avg_away_goals',
                                        // 'clubs.total_avg_home_corners',
                                        // 'clubs.total_avg_away_corners',
                                        'clubs.home_corner_club',
                                        'clubs.away_corner_club',
                                    )
                                    ->whereIn('clubs.id',[$Cornerkick->home_clubs_id,$Cornerkick->away_clubs_id,])
                                    ->orderBy('nama','Asc')
                                    ->get();

        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'Cornerkick',
                    'fixture',
                    'bet_status',
                    'bet_corner_status',
                    'bet_accuracy',
                    'htoh_data',
                    'home_ss',
                    'away_ss',
                    'clubs'
                )
            );
    }

    public function update(Request $request, Fixture $Cornerkick)
    {
        $content    = 'Cornerkick';

        $Cornerkick = Fixture::findOrFail($Cornerkick->id);

        $Cornerkick->update([
            'my_bet'                => $request->my_bet,
            'corner_bet'                => $request->corner_bet,
            'akurasi'                => $request->akurasi,
            'notes'                => $request->notes
        ]);

        if($Cornerkick){
            //redirect dengan pesan sukses
            return redirect()
                ->route('Cornerkick.index')
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route('Cornerkick.index')
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
}
