<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\League;
use App\Models\Team_league;

class BrazilController extends Controller
{
    public function index()
    {
        $data       = League::where('countries_id', 2)->get();
        $content    = 'Brazil';
        return view('content.backend.leagues.data', compact('data', 'content'));
    }

    public function create()
    {
        $content    = 'Brazil';
        return view('content.backend.leagues.create', compact('content'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'tahun'     => 'required'
        ]);

        $data = League::create([
            'nama'          => $request->nama,
            'tahun'         => $request->tahun,
            'countries_id'  => 2
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                ->route('Brazil.index')
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route('Brazil.index')
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
}
