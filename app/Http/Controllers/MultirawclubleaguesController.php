<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club_league;
use App\Models\Raw_club_league;

class MultirawclubleaguesController extends Controller
{
    //
    public function create($leagues_id)
    {
        $content    = 'Multirawclubleagues';
        $panel_name = 'Multirawclubleagues';

        return  view('content.backend.'.strtolower($content).'.create', 
                compact(
                    'content', 
                    'panel_name',
                    'leagues_id'
                )
            );
    }    

    public function store(Request $request)
    {
        $content    = 'Multirawclubleagues';

        $this->validate($request, [
            'leagues_id'      => 'required',
            'raw_text'          => 'required',
        ]);        
        
        //$pre_edited_raw_text        = str_replace('--', '-', $request->raw_text);
        $edited_raw_text    = str_replace(' ', '//', preg_replace('/\s+/', ' ', $request->raw_text));

        $data = Raw_club_league::create([
            'leagues_id'      => $request->leagues_id,

            'raw_text'          => $request->raw_text,
            'post_raw_text'     => $edited_raw_text,
        ]);

        if($data)
        {
            CLub_league::create_multi_raw_club_league($request->leagues_id, $edited_raw_text);

            return redirect()
                ->route('Club_leagues.index_list', $request->leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }
        else
        {

            return redirect()
                ->route($content.'.show', $request->leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }  
}
