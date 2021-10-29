<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Country;

class ClubsController extends Controller
{
    public function index()
    {
        $data          = Country::join('clubs', 'clubs.countries_id', '=', 'countries.id')
                            ->select('clubs.id', 'clubs.nama', 'countries.nama as nama_countries')
                            ->get();

        $content    = 'Clubs';
        $panel_name = 'Clubs';

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
        $data       = club::where('countries_id', $countries_id)
                        ->get();

        $country    = Country::where('id', $countries_id)->value('nama');

        $content    = 'Clubs';
        $panel_name = $country .' Clubs';

        return view('content.backend.clubs.index_list', 
                compact(
                    'data', 
                    'panel_name', 
                    'countries_id',
                    'content'
                ));
    }

    public function create()
    {
        $content    = 'Clubs';
        $panel_name = 'Clubs';

        $country       = Country::
                            orderBy('nama')
                            ->get();

        return  view('content.backend.'.strtolower($content).'.create', 
                compact(
                    'content', 
                    'panel_name',
                    'country'
                )
            );
    }

    public function store(Request $request)
    {
        $content    = 'Clubs';
        
        $this->validate($request, [
            'nama'              => 'required',
            'countries_id'      => 'required',
        ]);

        $data = Club::create([
            'nama'              => $request->nama,
            'countries_id'      => $request->countries_id,
        ]);

        if($data)
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

    public function edit(Club $Club)
    {
        $content    = 'Clubs';
        $panel_name = 'Clubs';

        $country       = Country::
                            orderBy('nama')
                            ->get();
        
        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'Club',
                    'country'
                )
            );
    }

    public function update(Request $request, Club $Club)
    {
        $content    = 'Clubs';

        $this->validate($request, [
            'nama'              => 'required',
            'countries_id'      => 'required',
        ]);

        $Club = Club::findOrFail($Club->id);

        $Club->update([
            'nama'              => $request->nama,
            'countries_id'      => $request->countries_id,
        ]);

        if($Club)
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
}
