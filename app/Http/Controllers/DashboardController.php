<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club_league;

class DashboardController extends Controller
{
    //
    public function index()
    {        
        $over_over      = Club_league::top_corner_club('Over','Over');

        $content        = 'Dashboard';
        $panel_name     = 'Dashboard';

        return view('content.backend.'.strtolower($content).'.index', 
                compact(
                    'panel_name', 
                    'content', 
                    'over_over'
                ));
    }
}
