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

        return view('content.backend.'.strtolower($content).'.index', 
                compact(
                    'data', 
                    'content', 
                    'panel_name'
                )
            );
    }

    public function create()
    {
        $content    = 'Countries';
        $panel_name = 'Countries';

        return  view('content.backend.'.strtolower($content).'.create', 
                compact(
                    'content', 
                    'panel_name'
                )
            );
    }

    public function store(Request $request)
    {
        $content    = 'Countries';
        
        $this->validate($request, [
            'nama'   => 'required'
        ]);

        $data = Country::create([
            'nama'     => $request->nama,
            'flag_icon'     => $request->flag_icon
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

    public function edit(Country $Country)
    {
        $content    = 'Countries';
        $panel_name = 'Countries';
        
        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'Country'
                )
            );
    }

    public function update(Request $request, Country $Country)
    {
        $content    = 'Countries';

        $this->validate($request, [
            'nama'              => 'required',
        ]);

        $Country = Country::findOrFail($Country->id);

        $Country->update([
            'nama'              => $request->nama,
            'flag_icon'              => $request->flag_icon,
        ]);

        if($Country)
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

    public function show(Country $Country)
    {
        $content    = 'Countries';
        $panel_name = 'Countries';

        
        return  view('content.backend.'.strtolower($content).'.show', 
                compact(
                    'content', 
                    'panel_name',
                    'Country'
                )
            );
    }

    public function destroy($id)
    {
        $content    = 'Countries';
        $panel_name = 'Countries';

        $course = Country::findOrFail($id);
        $course->delete();

        if($course){        
            return redirect()
                ->route($content.'.index')
                ->with(['Deleted' => 'Data successfully deleted!']);
        }else{
            return redirect()
                ->route($content.'.index')
                ->with(['Error' => 'Data Gagal Disimpan!']);
        }
    }

}
