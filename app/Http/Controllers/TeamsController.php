<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamsController extends Controller
{
    public function index()
    {
        $data       = Team::get();

        $content    = 'Teams';


        $panel_name = 'Statistic '.$content.' Leagues';

        return view('content.backend.'.strtolower($content).'.data', 
            compact(
                'data', 
                'panel_name', 
                'content'
            ));
    }

    public function create()
    {
        $content    = 'Teams';
        return view('content.backend.'.strtolower($content).'.create', compact('content'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'   => 'required'
        ]);

        $data = Team::create([
            'nama'     => $request->nama
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                ->route('Teams.index')
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route('Teams.index')
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
}
