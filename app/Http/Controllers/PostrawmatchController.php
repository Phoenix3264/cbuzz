<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\league;
use App\Models\Flashscoretext;
use App\Models\Club_league;

class PostrawmatchController extends Controller
{
    //
    public function create($leagues_id)
    {
        $content    = 'Postrawmatch';
        $panel_name = 'Postrawmatch';

        return  view('content.backend.'.strtolower($content).'.create', 
                compact(
                    'content', 
                    'panel_name',
                    'leagues_id',
                )
            );
    }   

    public function store(Request $request)
    {
        $content    = 'Postrawmatch';

        $this->validate($request, [
            'raw_text'              => 'required',
            'leagues_id'              => 'required',
        ]);
        
        $leagues_id     = $request->leagues_id;

        $edited_raw_text = str_replace(' ', '//', preg_replace('/\s+/', ' ', $request->raw_text));

        $str_replace_raw_text = $edited_raw_text;

        $model_flashscoretext = Flashscoretext::get();

        foreach($model_flashscoretext as $row)
        {
            $str_replace_raw_text = str_replace($row->nama, '', $str_replace_raw_text);
        }

        $data = Fixture::create([
            'leagues_id'          => $leagues_id,
            'raw_text'              => $edited_raw_text,
            //           
            'round_league'          => round_league($edited_raw_text, 'Round'),

            'home_clubs_id'      => club($edited_raw_text, 'Home', $leagues_id),
            'away_clubs_id'      => club($edited_raw_text, 'Away', $leagues_id),

            'home_goals'      => goals($edited_raw_text, 'Home'),
            'away_goals'      => goals($edited_raw_text, 'Away'),

            'home_ball_possession'      => ball_possession($edited_raw_text, 'Home'),
            'away_ball_possession'      => ball_possession($edited_raw_text, 'Away'),

            'home_goal_attempts'        => goal_attempts($edited_raw_text, 'Home'),
            'away_goal_attempts'        => goal_attempts($edited_raw_text, 'Away'),

            'home_shots_on_goals'       => shots_on_goal($edited_raw_text, 'Home'),
            'away_shots_on_goals'       => shots_on_goal($edited_raw_text, 'Away'),
            
            'home_shots_off_goals'      => shots_off_goal($edited_raw_text, 'Home'),
            'away_shots_off_goals'      => shots_off_goal($edited_raw_text, 'Away'),
            
            'home_blocked_shots'      => blocked_shots($edited_raw_text, 'Home'),
            'away_blocked_shots'      => blocked_shots($edited_raw_text, 'Away'),
            
            'home_free_kicks'           => free_kicks($edited_raw_text, 'Home'),
            'away_free_kicks'           => free_kicks($edited_raw_text, 'Away'),

            'home_corners'              => corner_kicks($edited_raw_text, 'Home'),
            'away_corners'              => corner_kicks($edited_raw_text, 'Away'),

            'home_offsides'              => offsides($edited_raw_text, 'Home'),
            'away_offsides'              => offsides($edited_raw_text, 'Away'),

            'home_throw_in'              => throw_in($edited_raw_text, 'Home'),
            'away_throw_in'              => throw_in($edited_raw_text, 'Away'),

            'home_goalkeeper_saves'              => goalkeeper_saves($edited_raw_text, 'Home'),
            'away_goalkeeper_saves'              => goalkeeper_saves($edited_raw_text, 'Away'),
            
            'home_red_cards'         => red_cards($edited_raw_text, 'Home'),
            'away_red_cards'         => red_cards($edited_raw_text, 'Away'),

            'home_yellow_cards'         => yellow_cards($edited_raw_text, 'Home'),
            'away_yellow_cards'         => yellow_cards($edited_raw_text, 'Away'),
            
            'home_tackles'              => tackles($edited_raw_text, 'Home'),
            'away_tackles'              => tackles($edited_raw_text, 'Away'),
            
            'home_attacks'              => attacks($edited_raw_text, 'Home'),
            'away_attacks'              => attacks($edited_raw_text, 'Away'),
            
            'home_fouls'                => fouls($edited_raw_text, 'Home'),
            'away_fouls'                => fouls($edited_raw_text, 'Away'),

            'home_total_passes'                => total_passes($edited_raw_text, 'Home'),
            'away_total_passes'                => total_passes($edited_raw_text, 'Away'),

            'home_completed_passes'                => completed_passes($edited_raw_text, 'Home'),
            'away_completed_passes'                => completed_passes($edited_raw_text, 'Away'),
            
            'home_dangerous_attacks'    => dangerous_attacks($edited_raw_text, 'Home'),
            'away_dangerous_attacks'    => dangerous_attacks($edited_raw_text, 'Away'),

            'post_raw_text' => $str_replace_raw_text,
        ]);

        if($data){
            //redirect dengan pesan sukses
            return redirect()
                ->route('Postrawmatch.create', $request->leagues_id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route($content.'.show', $request->leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }  

    public function edit(Fixture $Postrawmatch)
    {
        $content    = 'Postrawmatch';
        $panel_name = 'Postrawmatch';

        $model_leagues   = League::find($Postrawmatch->leagues_id);
        
        if($model_leagues->countries_id != 4)
        {
            $club       = league::join('countries', 'countries.id', '=', 'leagues.countries_id')
                        ->join('clubs', 'clubs.countries_id', '=', 'countries.id')
                            ->select(
                                'clubs.id', 
                                'clubs.nama')
                            ->where('leagues.id', $Postrawmatch->leagues_id)
                            ->orderBy('nama')
                            ->get();
        }
        else
        {
            $club   = Club_league::join('clubs', 'clubs.id', '=', 'club_leagues.clubs_id')
                            ->select(
                                    'clubs.id', 
                                    'clubs.nama')
                                ->where('club_leagues.leagues_id', $Postrawmatch->leagues_id)
                                ->orderBy('nama')
                                ->get();
        }

        
        return  view('content.backend.'.strtolower($content).'.edit', 
                compact(
                    'content', 
                    'panel_name',
                    'Postrawmatch',
                    'club'
                )
            );
    }

    public function update(Request $request, Fixture $Postrawmatch)
    {
        $content    = 'Postrawmatch';

        $model_flashscoretext = Flashscoretext::get();

        $this->validate($request, [
            'raw_text'              => 'required',
        ]);

        $Postrawmatch = Fixture::findOrFail($Postrawmatch->id);

        $edited_raw_text = str_replace(' ', '//', preg_replace('/\s+/', ' ', $request->raw_text));

        $str_replace_raw_text = $edited_raw_text;

        foreach($model_flashscoretext as $row)
        {
            $str_replace_raw_text = str_replace($row->nama, '', $str_replace_raw_text);
        }

        $Postrawmatch->update([
            'raw_text'                  => $edited_raw_text,
            //           
            'round_league'              => round_league($edited_raw_text, 'Round'),

            'home_goals'                => goals($edited_raw_text, 'Home'),
            'away_goals'                => goals($edited_raw_text, 'Away'),

            'home_ball_possession'      => ball_possession($edited_raw_text, 'Home'),
            'away_ball_possession'      => ball_possession($edited_raw_text, 'Away'),

            'home_goal_attempts'        => goal_attempts($edited_raw_text, 'Home'),
            'away_goal_attempts'        => goal_attempts($edited_raw_text, 'Away'),

            'home_shots_on_goals'       => shots_on_goal($edited_raw_text, 'Home'),
            'away_shots_on_goals'       => shots_on_goal($edited_raw_text, 'Away'),
            
            'home_shots_off_goals'      => shots_off_goal($edited_raw_text, 'Home'),
            'away_shots_off_goals'      => shots_off_goal($edited_raw_text, 'Away'),
            
            'home_blocked_shots'        => blocked_shots($edited_raw_text, 'Home'),
            'away_blocked_shots'        => blocked_shots($edited_raw_text, 'Away'),
            
            'home_free_kicks'           => free_kicks($edited_raw_text, 'Home'),
            'away_free_kicks'           => free_kicks($edited_raw_text, 'Away'),

            'home_corners'              => corner_kicks($edited_raw_text, 'Home'),
            'away_corners'              => corner_kicks($edited_raw_text, 'Away'),

            'home_offsides'              => offsides($edited_raw_text, 'Home'),
            'away_offsides'              => offsides($edited_raw_text, 'Away'),

            'home_throw_in'              => throw_in($edited_raw_text, 'Home'),
            'away_throw_in'              => throw_in($edited_raw_text, 'Away'),

            'home_goalkeeper_saves'      => goalkeeper_saves($edited_raw_text, 'Home'),
            'away_goalkeeper_saves'      => goalkeeper_saves($edited_raw_text, 'Away'),
            
            'home_red_cards'             => red_cards($edited_raw_text, 'Home'),
            'away_red_cards'             => red_cards($edited_raw_text, 'Away'),

            'home_yellow_cards'         => yellow_cards($edited_raw_text, 'Home'),
            'away_yellow_cards'         => yellow_cards($edited_raw_text, 'Away'),
            
            'home_tackles'              => tackles($edited_raw_text, 'Home'),
            'away_tackles'              => tackles($edited_raw_text, 'Away'),
            
            'home_attacks'              => attacks($edited_raw_text, 'Home'),
            'away_attacks'              => attacks($edited_raw_text, 'Away'),
            
            'home_fouls'                => fouls($edited_raw_text, 'Home'),
            'away_fouls'                => fouls($edited_raw_text, 'Away'),

            'home_total_passes'                => total_passes($edited_raw_text, 'Home'),
            'away_total_passes'                => total_passes($edited_raw_text, 'Away'),

            'home_completed_passes'                => completed_passes($edited_raw_text, 'Home'),
            'away_completed_passes'                => completed_passes($edited_raw_text, 'Away'),
            
            'home_dangerous_attacks'    => dangerous_attacks($edited_raw_text, 'Home'),
            'away_dangerous_attacks'    => dangerous_attacks($edited_raw_text, 'Away'),

            'post_raw_text' => $str_replace_raw_text,
        ]);

        if($Postrawmatch)
        {    
            //redirect dengan pesan sukses
            // Postmatch.edit', $row->id
            return redirect()
                ->route('Postmatch.edit', $Postrawmatch->id)
                ->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()
                ->route('Fixtures.show', $Postrawmatch->leagues_id)
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
}
