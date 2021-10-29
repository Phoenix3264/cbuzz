<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club_league;
use App\Models\league;
use App\Models\Raw_fixture;
use App\Models\Fixture;

class MultirawfixturesController extends Controller
{
    //
    public function create($leagues_id)
    {
        $content    = 'Multirawfixtures';
        $panel_name = 'Multirawfixtures';

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
        $content    = 'Multirawfixtures';

        $this->validate($request, [
            'leagues_id'      => 'required',
            'round_league'    => 'required',

            'raw_text'          => 'required',
        ]);        
        
        //$pre_edited_raw_text        = str_replace('--', '-', $request->raw_text);
        $edited_raw_text    = str_replace(' ', '//', preg_replace('/\s+/', ' ', $request->raw_text));

        $data = Raw_fixture::create([
            'leagues_id'      => $request->leagues_id,
            'round_league'    => $request->round_league,

            'raw_text'          => $request->raw_text,
            'post_raw_text'     => $edited_raw_text,
        ]);

        if($data)
        {
            Fixture::create_multi_raw_fixtures($request->leagues_id,$request->round_league,$edited_raw_text);

            return redirect()
                ->route('Fixtures.index_list', $request->leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }
        else
        {

            return redirect()
                ->route($content.'.show', $request->leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }  

    public function edit(Raw_fixture $Multirawfixture)
    {
        $content    = 'Multirawfixtures';
        $panel_name = 'Multirawfixtures';
                
        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'Multirawfixture'
                )
            );
    }

    public function update(Request $request, Raw_fixture $Raw_fixture)
    {
        $content    = 'Multirawfixtures';


        $model_Raw_fixture = Raw_fixture::findOrFail($Raw_fixture->id);

        
        $pre_edited_raw_text    = str_replace(' ', '//', preg_replace('/\s+/', ' ', $request->raw_text));
        $edited_raw_text        = str_replace('--', '-', $request->raw_text);

        $model_Raw_fixture->update([
            'raw_text'          => $request->raw_text,
            'post_raw_text'     => $edited_raw_text,
        ]);

        if($model_Raw_fixture){
            //redirect dengan pesan sukses
            return redirect()
                ->route($content.'.edit', $request->id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route($content.'.show', $request->id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
}
