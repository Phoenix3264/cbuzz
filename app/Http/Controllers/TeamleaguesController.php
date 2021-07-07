<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\League;
use App\Models\Team;
use App\Models\Country;
use App\Models\Team_league;

class TeamleaguesController extends Controller
{   

    public function create($leagues_id)
    {
        $countries_id   = League::where('id', $leagues_id)->value('countries_id');

        $content        = Country::where('id', $countries_id)->value('nama');

        $league_model   = League::where('id', $leagues_id)->first();

        $league_name    = $league_model->nama;
        $teams          = Team::orderby('nama','asc')->get();

        $panel_name = 'Team '.$content.' Leagues';

        return view('content.backend.teamleagues.create', 
                compact(
                    'content',
                    'leagues_id',
                    'league_name',
                    'panel_name',
                    'teams'
                    )
            );
    }

    public function store(Request $request)
    {
        $leagues_id         = $request->leagues_id;
        $countries_id       = League::where('id', $leagues_id)->value('countries_id');

        $countries_name       = Country::where('id', $countries_id)->value('nama');

        $this->validate($request, [
            'leagues_id'    => 'required',
            'teams_id'      => 'required'
        ]);

        $data = Team_league::create([
            'leagues_id'    => $request->leagues_id,
            'teams_id'      => $request->teams_id
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                ->route('Teamleagues.show', $leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route('Teamleagues.show', $leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    

    public function show($id)
    {
        $data       = Team_league::join('teams', 'teams.id', '=', 'team_leagues.teams_id')
            ->select('teams.id', 'teams.nama')
            ->where('team_leagues.leagues_id', $id)
            ->get();


        $content    = 'Brazil';
        $leagues_id = $id;


        $panel_name    = 'Brazil';

        return view('content.backend.teamleagues.data', 
            compact(
                'data', 
                'content',
                'panel_name',
                'leagues_id'
            ));
    }
}
