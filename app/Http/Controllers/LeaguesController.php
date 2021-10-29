<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\League;

class LeaguesController extends Controller
{
    public function index()
    {
        $data          = Country::join('leagues', 'leagues.countries_id', '=', 'countries.id')
                            ->select('leagues.id', 
                            'leagues.nama', 
                            'leagues.tahun', 
                            'countries.nama as nama_countries')
                            ->get();

        $content    = 'Leagues';
        $panel_name = 'Leagues';

        return view('content.backend.'.strtolower($content).'.index', 
                compact(
                    'data', 
                    'content', 
                    'panel_name'
                )
            );
    }

    public function index_list($countries_id)
    {
        $data       = League::where('countries_id', $countries_id)
                        ->get();

        $country    = Country::where('id', $countries_id)->value('nama');

        $content    = 'Leagues';
        $panel_name = $country .' Leagues';

        return view('content.backend.leagues.index_list', 
                compact(
                    'data', 
                    'panel_name', 
                    'countries_id',
                    'content'
                ));
    }

    public function create($countries_id)
    {
        $content    = 'Leagues';

        $country    = Country::where('id', $countries_id)->value('nama');

        $content    = 'Leagues';
        $panel_name = $country .' Leagues';

        return  view('content.backend.'.strtolower($content).'.create', 
                compact(
                    'content', 
                    'panel_name',
                    'countries_id'
                )
            );
    }

    public function store(Request $request)
    {
        $content    = 'Leagues';
        
        $this->validate($request, [
            'nama'      => 'required',
            'tahun'     => 'required'
        ]);

        $data = League::create([
            'nama'          => $request->nama,
            'tahun'         => $request->tahun,
            'countries_id'  => $request->countries_id
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                ->route($content.'.index_list', $request->countries_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route($content.'.show', $request->countries_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
   

    public function edit(League $League)
    {
        $content    = 'Leagues';
        $panel_name = 'Leagues';
        
        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'League'
                )
            );
    }

    public function update(Request $request, League $League)
    {
        $content    = 'Leagues';

        $this->validate($request, [
            'nama'              => 'required',
        ]);

        $League = League::findOrFail($League->id);

        $League->update([
            'nama'              => $request->nama,
            'tahun'              => $request->tahun,
        ]);

        if($League)
        {
            return redirect()
                ->route($content.'.index')
                ->with(['Success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()
                ->route($content.'.index')
                ->with(['Error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(League $League)
    {
        $content    = 'Leagues';
        $panel_name = 'Leagues';

        
        return  view('content.backend.'.strtolower($content).'.show', 
                compact(
                    'content', 
                    'panel_name',
                    'League'
                )
            );
    }
}
