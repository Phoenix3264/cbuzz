<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\League;

class CountriesController extends Controller
{
    public function index()
    {
        $data       = Country::get();
        $content    = 'Countries';
        $panel_name = 'Countries';
        return view('content.backend.'.strtolower($content).'.data', compact('data', 'content', 'panel_name'));
    }

    public function create()
    {
        $content    = 'Countries';
        return view('content.backend.'.strtolower($content).'.create', compact('content'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'   => 'required'
        ]);

        $data = Country::create([
            'nama'     => $request->nama
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                ->route('Countries.index')
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route('Countries.index')
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show($countries_id)
    {
        $data       = League::where('countries_id', $countries_id)
                        ->get();

        $content    = Country::where('id', $countries_id)->value('nama');

        $panel_name = $content. ' Leagues';

        return view('content.backend.leagues.data', 
                compact(
                    'data', 
                    'panel_name', 
                    'content'
                ));
    }
}
