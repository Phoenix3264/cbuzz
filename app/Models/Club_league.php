<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club_league extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'id',
        'leagues_id',
        'clubs_id',

        'min_home_goals',
        'total_avg_home_goals',
        'max_home_goals',

        'min_away_goals',
        'total_avg_away_goals',
        'max_away_goals',

        'min_home_corners',
        'total_avg_home_corners',
        'max_home_corners',

        'min_away_corners',
        'total_avg_away_corners',
        'max_away_corners',

        // new
            'goals_home_min',
            'goals_home_avg',
            'goals_home_max',
            'goals_away_min',
            'goals_away_avg',
            'goals_away_max',

            'corners_home_min',
            'corners_home_avg',
            'corners_home_max',
            'corners_away_min',
            'corners_away_avg',
            'corners_away_max',

            'yellow_cards_home_min',
            'yellow_cards_home_avg',
            'yellow_cards_home_max',
            'yellow_cards_away_min',
            'yellow_cards_away_avg',
            'yellow_cards_away_max',

            'red_cards_home_min',
            'red_cards_home_avg',
            'red_cards_home_max',
            'red_cards_away_min',
            'red_cards_away_avg',
            'red_cards_away_max',
        //
            'home_win_corners',
            'home_draw_corners',
            'home_lose_corners',

            'away_win_corners',
            'away_draw_corners',
            'away_lose_corners',

        'home_corner_club',
        'away_corner_club',

        'points',
        'corner_fav',
    ];

    protected $hidden = ["deleted_at"];

    public static function create_multi_raw_club_league($leagues_id, $edited_raw_text)
    {        
        $str_replace_raw_text = explode('//', $edited_raw_text);

        for ($i=0; $i < count($str_replace_raw_text); $i++) 
        { 
            $clubs_id = define_club($str_replace_raw_text[$i], ' ', NULL);
            
            if(!is_null($clubs_id))
            {
                Club_league::create([
                    'leagues_id'      => $leagues_id,
                    'clubs_id'    => $clubs_id,
                ]);
            }
        }
    }

    public static function update_calibrate_club_leagues($leagues_id, $clubs_id)
    {   
        // set model     
        // Club_league::update_calibrate($model->leagues_id,$model->home_clubs_id);
        $model = Club_league::where('leagues_id', $leagues_id)
                                ->where('clubs_id', $clubs_id)
                                ->first();


        
        $model->update([ 
            'goals_home_min'              => min_max($leagues_id, $clubs_id, $value1, $value2, $value3),
            'goals_home_avg'              => Fixture::avg_me($leagues_id, $clubs_id, 'home', 'home_goals'),
            'goals_home_max'              => round_league($edited_raw_text, 'Round'),

            'goals_away_min'              => round_league($edited_raw_text, 'Round'),
            'goals_away_avg'              => Fixture::avg_me($leagues_id, $clubs_id, 'away', 'away_goals'),
            'goals_away_max'              => round_league($edited_raw_text, 'Round'),

            'corners_home_min'              => round_league($edited_raw_text, 'Round'),
            'corners_home_avg'              => Fixture::avg_me($leagues_id, $clubs_id, 'home', 'home_corners'),
            'corners_home_max'              => round_league($edited_raw_text, 'Round'),

            'corners_away_min'              => round_league($edited_raw_text, 'Round'),
            'corners_away_avg'              => Fixture::avg_me($leagues_id, $clubs_id, 'away', 'away_corners'),
            'corners_away_max'              => round_league($edited_raw_text, 'Round'),

            'yellow_cards_home_min'              => round_league($edited_raw_text, 'Round'),
            'yellow_cards_home_avg'              => Fixture::avg_me($leagues_id, $clubs_id, 'home', 'home_yellow_cards'),
            'yellow_cards_home_max'              => round_league($edited_raw_text, 'Round'),

            'yellow_cards_away_min'              => round_league($edited_raw_text, 'Round'),
            'yellow_cards_away_avg'              => Fixture::avg_me($leagues_id, $clubs_id, 'away', 'away_yellow_cards'),
            'yellow_cards_away_max'              => round_league($edited_raw_text, 'Round'),

            'red_cards_home_min'              => round_league($edited_raw_text, 'Round'),
            'red_cards_home_avg'              => Fixture::avg_me($leagues_id, $clubs_id, 'home', 'home_red_cards'),
            'red_cards_home_max'              => round_league($edited_raw_text, 'Round'),

            'red_cards_away_min'              => round_league($edited_raw_text, 'Round'),
            'red_cards_away_avg'              => Fixture::avg_me($leagues_id, $clubs_id, 'away', 'away_red_cards'),
            'red_cards_away_max'              => round_league($edited_raw_text, 'Round'),


            'home_win_corners'           => Fixture::count_wdl($leagues_id, $clubs_id, 'home_wdl_corners', 'Win'),
            'home_draw_corners'          => Fixture::count_wdl($leagues_id, $clubs_id, 'home_wdl_corners', 'Draw'),
            'home_lose_corners'          => Fixture::count_wdl($leagues_id, $clubs_id, 'home_wdl_corners', 'Lose'),

            'away_win_corners'           => Fixture::count_wdl($leagues_id, $clubs_id, 'away_wdl_corners', 'Win'),
            'away_draw_corners'          => Fixture::count_wdl($leagues_id, $clubs_id, 'away_wdl_corners', 'Draw'),
            'away_lose_corners'          => Fixture::count_wdl($leagues_id, $clubs_id, 'away_wdl_corners', 'Lose'),
        ]);

    }

    public static function top_corner_club($home_corner, $away_corner)
    {
        $content =  Club_league::join('leagues', 'leagues.id', '=', 
                                        'club_leagues.leagues_id')
                                ->join('clubs', 'clubs.id', '=', 
                                        'club_leagues.clubs_id')
                                ->select(
                                    'leagues.nama as leagues_name', 
                                    'clubs.nama as clubs_name', 
                                    // 'club_leagues.total_avg_home_goals', 
                                    // 'club_leagues.total_avg_away_goals'
                                    )
                                ->whereNotNull('leagues.dashboard_corner')
                                ->orderBy('leagues.dashboard_corner')
                                ->get();        

        return $content;
    }

    public static function row_me($leagues_id, $clubs_id, $value)
    {
        $model =  Club_league::where('leagues_id',$leagues_id)
                                ->where('clubs_id', $clubs_id)
                                ->value($value);
        
        $content = $model;
        
        if($value = 'points')
        {                    
            if(is_null($model))
            {
                $content = 0;
            }
        }

        return $content;
    }

    /*
    public static function Postmatch($leagues_id, $clubs_id)
    {
        $points = Fixture::total_points($leagues_id, $clubs_id);

        $total_avg_home_goals = Fixture::avg_me($leagues_id, $clubs_id, 'home', 'home_goals');
        $total_avg_away_goals = Fixture::avg_me($leagues_id, $clubs_id, 'away', 'away_goals');

        $total_avg_home_corners = Fixture::avg_me($leagues_id, $clubs_id, 'home', 'home_corners');
        $total_avg_away_corners = Fixture::avg_me($leagues_id, $clubs_id, 'away', 'away_corners');

        $home_corner_club = Fixture::corner_club($leagues_id, $clubs_id, 'home');
        $away_corner_club = Fixture::corner_club($leagues_id, $clubs_id, 'away');

        Club_league::where('leagues_id', $leagues_id)
                        ->where('clubs_id', $clubs_id)
                        ->update([
                            'total_avg_home_goals'      => $total_avg_home_goals,
                            'total_avg_away_goals'      => $total_avg_away_goals,
                            'total_avg_home_corners'    => $total_avg_home_corners,
                            'total_avg_away_corners'    => $total_avg_away_corners,
                            'home_corner_club'          => $home_corner_club,
                            'away_corner_club'          => $away_corner_club,
                            'points'                    => $points,
                        ]);
    }
    */

}
