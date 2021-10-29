<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fixture extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'leagues_id',
        'round_league',
        'home_clubs_id',
        'away_clubs_id',
        'home_hdp_goals',
        'away_hdp_goals',
        'over_under_goals',
        'home_hdp_corners',
        'away_hdp_corners',
        'over_under_corners',
        
        'home_goals',
        'away_goals',
        
        'home_corners',
        'away_corners',

        'max_corners',
        'min_corners',

        'home_status',
        'away_status',
        
        'prematch_total_avg_goals_as_home',
        'prematch_total_avg_goals_as_away',
        
        'prematch_total_avg_corners_as_home',
        'prematch_total_avg_corners_as_away',

        'last_home_points',
        'last_away_points',

        'my_bet',
        'corner_bet',
        'bet_status',

        'handicap_voor_goals_status',
        'handicap_voor_corners_status',
        
        'over_goals_status',
        'over_corners_status',
        
        'akurasi',
        'notes',

        'home_ball_possession',
        'away_ball_possession',

        'home_goal_attempts',
        'away_goal_attempts',

        'home_shots_on_goals',
        'away_shots_on_goals',

        'home_shots_off_goals',
        'away_shots_off_goals',

        'home_blocked_shots',
        'away_blocked_shots',

        'home_free_kicks',
        'away_free_kicks',

        'home_offsides',
        'away_offsides',

        'home_throw_in',
        'away_throw_in',

        'home_goalkeeper_saves',
        'away_goalkeeper_saves',

        'home_red_cards',
        'away_red_cards',

        'home_yellow_cards',
        'away_yellow_cards',

        'home_tackles',
        'away_tackles',

        'home_attacks',
        'away_attacks',

        'home_fouls',
        'away_fouls',

        'home_total_passes',
        'away_total_passes',

        'home_completed_passes',
        'away_completed_passes',
        
        'home_dangerous_attacks',
        'away_dangerous_attacks',


        'over_goals',
        'under_goals',

        //
            'home_wdl_goals',
            'away_wdl_goals',

            'home_wdl_handicap_goals',
            'away_wdl_handicap_goals',

            'home_wdl_corners',
            'away_wdl_corners',

            'home_wdl_handicap_corners',
            'away_wdl_handicap_corners',

            'home_wdl_yellow_cards',
            'away_wdl_yellow_cards',

            'home_wdl_red_cards',
            'away_wdl_red_cards',

        'over_corners',
        'under_corners',
        'raw_text',
        'post_raw_text'

    ];

    protected $hidden = ["deleted_at"];

    public static function create_multi_raw_fixtures($leagues_id, $round_league, $edited_raw_text)
    {        
        $str_replace_raw_text = explode('//-//-//', $edited_raw_text);

        for ($i=0; $i < count($str_replace_raw_text); $i++) 
        { 
            $str_replace_raw_text_2 = explode('//', $str_replace_raw_text[$i]);

            if(count($str_replace_raw_text_2) == 4)
            {
                $home_clubs_id = define_club($str_replace_raw_text_2[2], $str_replace_raw_text_2[2], $leagues_id);
                $away_clubs_id = define_club($str_replace_raw_text_2[3], $str_replace_raw_text_2[3], $leagues_id);
                
                if(!is_null($home_clubs_id) && !is_null($away_clubs_id))
                {
                    Fixture::create([
                        'leagues_id'      => $leagues_id,
                        'round_league'    => $round_league,
                        'home_clubs_id'    => $home_clubs_id,
                        'away_clubs_id'    => $away_clubs_id,
                    ]);
                }
            }
            elseif(count($str_replace_raw_text_2) == 5)
            {
                $home_clubs_id = define_club($str_replace_raw_text_2[2],$str_replace_raw_text_2[3], $leagues_id);
                $away_clubs_id = define_club($str_replace_raw_text_2[3],$str_replace_raw_text_2[4], $leagues_id);

                if(is_null($home_clubs_id))
                {
                    $home_clubs_id = define_club($str_replace_raw_text_2[2],$str_replace_raw_text_2[2], $leagues_id);
                }
                if(is_null($away_clubs_id))
                {
                    $away_clubs_id = define_club($str_replace_raw_text_2[4],$str_replace_raw_text_2[4], $leagues_id);
                }
                
                if(!is_null($home_clubs_id) && !is_null($away_clubs_id))
                {
                    Fixture::create([
                        'leagues_id'      => $leagues_id,
                        'round_league'    => $round_league,
                        'home_clubs_id'    => $home_clubs_id,
                        'away_clubs_id'    => $away_clubs_id,
                    ]);
                }
            }
            elseif(count($str_replace_raw_text_2) == 6)
            {
                $home_clubs_id = define_club($str_replace_raw_text_2[2],$str_replace_raw_text_2[3], $leagues_id);
                $away_clubs_id = define_club($str_replace_raw_text_2[4],$str_replace_raw_text_2[5], $leagues_id);
                
                if(!is_null($home_clubs_id) && !is_null($away_clubs_id))
                {
                    Fixture::create([
                        'leagues_id'      => $leagues_id,
                        'round_league'    => $round_league,
                        'home_clubs_id'    => $home_clubs_id,
                        'away_clubs_id'    => $away_clubs_id,
                    ]);
                }
            }
        }
    }

    public static function update_calibrate($fixtures_id)
    {
        $real_value = 0;

        $model = Fixture::findOrFail($fixtures_id);

        $model->update([

            'home_wdl_goals'            => Fixture::bet_status($fixtures_id, 'home_wdl_goals'),
            'away_wdl_goals'            => Fixture::bet_status($fixtures_id, 'away_wdl_goals'),

            'home_wdl_handicap_goals'   => Fixture::bet_status($fixtures_id, 'home_wdl_handicap_goals'),
            'away_wdl_handicap_goals'   => Fixture::bet_status($fixtures_id, 'away_wdl_handicap_goals'),

            'home_wdl_corners'          => Fixture::bet_status($fixtures_id, 'home_wdl_corners'),
            'away_wdl_corners'          => Fixture::bet_status($fixtures_id, 'away_wdl_corners'),

            'home_wdl_handicap_corners' => Fixture::bet_status($fixtures_id, 'home_wdl_handicap_corners'),
            'away_wdl_handicap_corners' => Fixture::bet_status($fixtures_id, 'away_wdl_handicap_corners'),

            'home_wdl_yellow_cards'     => Fixture::bet_status($fixtures_id, 'home_wdl_yellow_cards'),
            'away_wdl_yellow_cards'     => Fixture::bet_status($fixtures_id, 'away_wdl_yellow_cards'),

            'home_wdl_red_cards'        => Fixture::bet_status($fixtures_id, 'home_wdl_red_cards'),
            'away_wdl_red_cards'        => Fixture::bet_status($fixtures_id, 'away_wdl_red_cards'),

            // home lose draw 
            // 'home_status' => Fixture::match_status($model->home_goals,$model->away_goals,'Home'),
            // 'away_status' => Fixture::match_status($model->home_goals,$model->away_goals,'Away'),

            // 'prematch_total_avg_goals_as_home'  => row_me($request->leagues_id,$model->home_goals,'home_goals'),
            // 'prematch_total_avg_goals_as_away'  => row_me($request->leagues_id,$model->away_goals,'away_goals'),

            // 'prematch_total_avg_corners_as_home' => row_me($request->leagues_id,$model->home_corners,'home_corners'),
            // 'prematch_total_avg_corners_as_away' => row_me($request->leagues_id,$model->away_corners,'away_corners'),

            // 'last_home_points'             => $request->last_home_points,
            // 'last_away_points'           => $request->last_away_points,

            // //
            // 'bet_status'    => $request->bet_status,
            
            // // goals
            // 'home_win' => Fixture::home_away_win_status($model->home_goals,$model->away_goals,'Home'),
            // 'away_win' => Fixture::home_away_win_status($model->home_goals,$model->away_goals,'Away'),

            // 'home_win_handicap_goals'       => $request->home_win_handicap_goals,
            // 'away_win_handicap_goals'       => $request->away_win_handicap_goals,

            // home lose draw 
            // 'over_goals_status'              => $request->over_goals_status,
            // 'over_corners_status'            => $request->over_corners_status,orners,

            // 'over_goals'                    => $request->over_goals,
            // 'under_goals'                   => $request->under_goals,

            // // corner
            // 'home_win_corners'              => $request->home_win_corners,
            // 'away_win_corners'              => $request->away_win_c

            // 'home_win_handicap_corners'     => $request->home_win_handicap_corners,
            // 'away_win_handicap_corners'     => $request->away_win_handicap_corners,

            // 'over_corners'                  => $request->over_corners,
            // 'under_corners'                 => $request->under_corners,
            
            // 'over_min_corners'              => $request->over_min_corners,
            // 'under_max_corners'             => $request->under_max_corners,
        ]);
    }

    public static function row_me($leagues_id, $clubs_id, $value)
    {
        $model =  Fixture::where('leagues_id',$leagues_id)
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
    
    public static function bet_status($id, $value)
    {
        $status = '';

        $model = Fixture::findOrFail($id);

        if($value == 'handicap_voor_goals_status')
        {
            if(!is_null($model->home_hdp_goals) && is_null($model->away_hdp_goals))
            {
                if(($model->home_goals + $model->home_hdp_goals) > $model->away_goals)
                {
                    $status = 2;
                }
                elseif(($model->home_goals + $model->home_hdp_goals) < $model->away_goals)
                {
                    $status = 1;
                }
                elseif(($model->home_goals + $model->home_hdp_goals) == $model->away_goals)
                {
                    $status = 3;
                }
            }
            elseif(!is_null($model->away_hdp_goals) && is_null($model->home_hdp_goals))
            {
                if($model->home_goals > ($model->away_goals + $model->away_hdp_goals))
                {
                    $status = 1;
                }
                elseif($model->home_goals < ($model->away_goals + $model->away_hdp_goals))
                {
                    $status = 2;
                }
                elseif($model->home_goals == ($model->away_goals + $model->away_hdp_goals))
                {
                    $status = 3;
                }
            }
        }
        elseif($value == 'over_goals_status' && !is_null($model->over_under_goals))
        {
            if(($model->home_goals + $model->away_goals) > $model->over_under_goals)
            {
                $status = 1;
            }
            elseif(($model->home_goals + $model->away_goals) < $model->over_under_goals)
            {
                $status = 2;
            }
            elseif(($model->home_goals + $model->away_goals) == $model->over_under_goals)
            {
                $status = 3;
            }
        }

        if($value == 'handicap_voor_corners_status')
        {
            if(!is_null($model->home_hdp_corners) && is_null($model->away_hdp_corners))
            {
                if(($model->home_corners + $model->home_hdp_corners) > $model->away_corners)
                {
                    $status = 2;
                }
                elseif(($model->home_corners + $model->home_hdp_corners) < $model->away_corners)
                {
                    $status = 1;
                }
                elseif(($model->home_corners + $model->home_hdp_corners) == $model->away_corners)
                {
                    $status = 3;
                }
            }
            elseif(!is_null($model->away_hdp_corners) && is_null($model->home_hdp_corners))
            {
                if($model->home_corners > ($model->away_corners + $model->away_hdp_corners))
                {
                    $status = 1;
                }
                elseif($model->home_corners < ($model->away_corners + $model->away_hdp_corners))
                {
                    $status = 2;
                }
                elseif($model->home_corners == ($model->away_corners + $model->away_hdp_corners))
                {
                    $status = 3;
                }

            }
        }
        elseif($value == 'over_corners_status' && !is_null($model->over_under_corners))
        {
            if(($model->home_corners + $model->away_corners) > $model->over_under_corners)
            {
                $status = 1;
            }
            elseif(($model->home_corners + $model->away_corners) < $model->over_under_corners)
            {
                $status = 2;
            }
            elseif(($model->home_corners + $model->away_corners) == $model->over_under_corners)
            {
                $status = 3;
            }
        }

        if($value == 'bet_status')
        {
            if($model->my_bet == 1) // home win
            {
                if($model->home_goals > $model->away_goals)
                {
                    $status = 1;
                }
                elseif($model->home_goals < $model->away_goals)
                {
                    $status = 2;
                }
                elseif($model->home_goals == $model->away_goals)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 2) // away win
            {
                if($model->home_goals > $model->away_goals)
                {
                    $status = 2;
                }
                elseif($model->home_goals < $model->away_goals)
                {
                    $status = 1;
                }
                elseif($model->home_goals == $model->away_goals)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 3) // home win handicap goals
            {
                if(($model->home_goals + $model->home_hdp_goals) > $model->away_goals)
                {
                    $status = 1;
                }
                elseif(($model->home_goals + $model->home_hdp_goals) < $model->away_goals)
                {
                    $status = 2;
                }
                elseif(($model->home_goals + $model->home_hdp_goals) == $model->away_goals)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 4) // away win handicap goals
            {
                if($model->home_goals > ($model->away_goals + $model->away_hdp_goals))
                {
                    $status = 2;
                }
                elseif($model->home_goals < ($model->away_goals + $model->away_hdp_goals))
                {
                    $status = 1;
                }
                elseif($model->home_goals == ($model->away_goals + $model->away_hdp_goals))
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 5) // over goals
            {
                if(($model->home_goals + $model->away_goals) > $model->over_under_goals)
                {
                    $status = 1;
                }
                elseif(($model->home_goals + $model->away_goals) < $model->over_under_goals)
                {
                    $status = 2;
                }
                elseif(($model->home_goals + $model->away_goals) == $model->over_under_goals)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 6) // under goals
            {
                if(($model->home_goals + $model->away_goals) > $model->over_under_goals)
                {
                    $status = 2;
                }
                elseif(($model->home_goals + $model->away_goals) < $model->over_under_goals)
                {
                    $status = 1;
                }
                elseif(($model->home_goals + $model->away_goals) == $model->over_under_goals)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 7) // home win corners
            {
                if($model->home_corners > $model->away_corners)
                {
                    $status = 1;
                }
                elseif($model->home_corners < $model->away_corners)
                {
                    $status = 2;
                }
                elseif($model->home_corners == $model->away_corners)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 8) // away win corners
            {
                if($model->home_corners > $model->away_corners)
                {
                    $status = 2;
                }
                elseif($model->home_corners < $model->away_corners)
                {
                    $status = 1;
                }
                elseif($model->home_corners == $model->away_corners)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 9) // home win handicap corners
            {
                if(($model->home_corners + $model->home_hdp_corners) > $model->away_corners)
                {
                    $status = 1;
                }
                elseif(($model->home_corners + $model->home_hdp_corners) < $model->away_corners)
                {
                    $status = 2;
                }
                elseif(($model->home_corners + $model->home_hdp_corners) == $model->away_corners)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 10) // away win handicap corners
            {
                if($model->home_corners > ($model->away_corners + $model->away_hdp_corners))
                {
                    $status = 2;
                }
                elseif($model->home_corners < ($model->away_corners + $model->away_hdp_corners))
                {
                    $status = 1;
                }
                elseif($model->home_corners == ($model->away_corners + $model->away_hdp_corners))
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 11) // over corners
            {
                if(($model->home_corners + $model->away_corners) > $model->over_under_corners)
                {
                    $status = 1;
                }
                elseif(($model->home_corners + $model->away_corners) < $model->over_under_corners)
                {
                    $status = 2;
                }
                elseif(($model->home_corners + $model->away_corners) == $model->over_under_corners)
                {
                    $status = 3;
                }
            }
            elseif($model->my_bet == 12) // under corners
            {
                if(($model->home_corners + $model->away_corners) > $model->over_under_corners)
                {
                    $status = 2;
                }
                elseif(($model->home_corners + $model->away_corners) < $model->over_under_corners)
                {
                    $status = 1;
                }
                elseif(($model->home_corners + $model->away_corners) == $model->over_under_corners)
                {
                    $status = 3;
                }

            }
        }


        if($value == 'home_wdl_goals')
        {
            if($model->home_goals > $model->away_goals)
            {
                $status = 1;
            }
            elseif($model->home_goals == $model->away_goals)
            {
                $status = 3;
            }
            elseif($model->home_goals < $model->away_goals)
            {
                $status = 2;
            }
        }
        elseif($value == 'away_wdl_goals')
        {
            if($model->home_goals > $model->away_goals)
            {
                $status = 2;
            }
            elseif($model->home_goals == $model->away_goals)
            {
                $status = 3;
            }
            elseif($model->home_goals < $model->away_goals)
            {
                $status = 1;
            }
        }
        elseif($value == 'home_wdl_handicap_goals')
        {
            if(($model->home_goals + $model->home_hdp_goals) > $model->away_goals && !is_null($model->home_hdp_goals))
            {
                $status = 1;
            }
            elseif(($model->home_goals + $model->home_hdp_goals) == $model->away_goals && !is_null($model->home_hdp_goals))
            {
                $status = 3;
            }
            elseif(($model->home_goals + $model->home_hdp_goals) < $model->away_goals && !is_null($model->home_hdp_goals))
            {
                $status = 2;
            }
        }
        elseif($value == 'away_wdl_handicap_goals')
        {
            if($model->home_goals < ($model->away_goals + $model->away_hdp_goals) && !is_null($model->away_hdp_goals))
            {
                $status = 1;
            }
            elseif($model->home_goals == ($model->away_goals + $model->away_hdp_goals) && !is_null($model->away_hdp_goals))
            {
                $status = 3;
            }
            elseif($model->home_goals > ($model->away_goals + $model->away_hdp_goals) && !is_null($model->away_hdp_goals))
            {
                $status = 2;
            }
        }
        elseif($value == 'over_goals')
        {
            if(($model->home_goals + $model->away_goals) > $model->over_under_goals && !is_null($model->over_under_goals))
            {
                $status = 1;
            }
        }
        elseif($value == 'under_goals')
        {
            if(($model->home_goals + $model->away_goals) < $model->over_under_goals && !is_null($model->over_under_goals))
            {
                $status = 1;
            }
        }
        elseif($value == 'home_wdl_corners')
        {
            if($model->home_corners > $model->away_corners)
            {
                $status = 1;
            }
            elseif($model->home_corners == $model->away_corners)
            {
                $status = 3;
            }
            elseif($model->home_corners < $model->away_corners)
            {
                $status = 2;
            }
        }
        elseif($value == 'away_wdl_corners')
        {
            if($model->home_corners > $model->away_corners)
            {
                $status = 2;
            }
            elseif($model->home_corners == $model->away_corners)
            {
                $status = 3;
            }
            elseif($model->home_corners < $model->away_corners)
            {
                $status = 1;
            }
        }
        elseif($value == 'home_wdl_handicap_corners')
        {
            if(($model->home_corners + $model->home_hdp_corners) > $model->away_corners && !is_null($model->home_hdp_corners))
            {
                $status = 1;
            }
            elseif(($model->home_corners + $model->home_hdp_corners) == $model->away_corners && !is_null($model->home_hdp_corners))
            {
                $status = 3;
            }
            elseif(($model->home_corners + $model->home_hdp_corners) < $model->away_corners && !is_null($model->home_hdp_corners))
            {
                $status = 2;
            }
        }
        elseif($value == 'away_wdl_handicap_corners')
        {
            if($model->home_corners < ($model->away_corners + $model->away_hdp_corners) && !is_null($model->away_hdp_corners))
            {
                $status = 2;
            }
            elseif($model->home_corners == ($model->away_corners + $model->away_hdp_corners) && !is_null($model->away_hdp_corners))
            {
                $status = 3;
            }
            elseif($model->home_corners > ($model->away_corners + $model->away_hdp_corners) && !is_null($model->away_hdp_corners))
            {
                $status = 1;
            }
        }
        elseif($value == 'home_wdl_yellow_cards')
        {
            if($model->home_yellow_cards > $model->away_yellow_cards)
            {
                $status = 1;
            }
            elseif($model->home_yellow_cards == $model->away_yellow_cards)
            {
                $status = 3;
            }
            elseif($model->home_yellow_cards < $model->away_yellow_cards)
            {
                $status = 2;
            }
        }
        elseif($value == 'away_wdl_yellow_cards')
        {
            if($model->home_yellow_cards > $model->away_yellow_cards)
            {
                $status = 2;
            }
            elseif($model->home_yellow_cards == $model->away_yellow_cards)
            {
                $status = 3;
            }
            elseif($model->home_yellow_cards < $model->away_yellow_cards)
            {
                $status = 1;
            }
        }
        elseif($value == 'home_wdl_red_cards')
        {
            if($model->home_red_cards > $model->away_red_cards)
            {
                $status = 1;
            }
            elseif($model->home_red_cards == $model->away_red_cards)
            {
                $status = 3;
            }
            elseif($model->home_red_cards < $model->away_red_cards)
            {
                $status = 2;
            }
        }
        elseif($value == 'away_wdl_red_cards')
        {
            if($model->home_red_cards > $model->away_red_cards)
            {
                $status = 2;
            }
            elseif($model->home_red_cards == $model->away_red_cards)
            {
                $status = 3;
            }
            elseif($model->home_red_cards < $model->away_red_cards)
            {
                $status = 1;
            }
        }
        elseif($value == 'over_corners')
        {
            if(($model->home_corners + $model->away_corners) > $model->over_under_corners && !is_null($model->over_under_corners))
            {
                $status = 1;
            }
        }
        elseif($value == 'under_corners')
        {
            if(($model->home_corners + $model->away_corners) < $model->over_under_corners && !is_null($model->over_under_corners))
            {
                $status = 1;
            }
        }

        if($status == 1)
        {
            return 'Win';
        }
        elseif($status == 2)
        {
            return 'Lose';
        }
        elseif($status == 3)
        {
            return 'Draw';
        }
        else
        {
            return NULL;
        }
    }

    public static function home_away_win_status($home_goals, $away_goals, $value)
    {
        $home_status    = Null;
        $away_status    = Null;

        if($home_goals > $away_goals)
        {
            $home_status = 'Win';
        }
        elseif($home_goals < $away_goals)
        {
            $away_status = 'Win';
        }

        if($value == 'Home')
        {
            return $home_status;
        }
        elseif($value == 'Away')
        {
            return $away_status;
        }
    }

    public static function match_status($home_goals, $away_goals, $value)
    {
        if($home_goals == $away_goals)
        {
            $home_status = 'Draw';
            $away_status = 'Draw';
        }
        elseif($home_goals > $away_goals)
        {
            $home_status = 'Win';
            $away_status = 'Lose';
        }
        elseif($home_goals < $away_goals)
        {
            $home_status = 'Lose';
            $away_status = 'Win';
        }

        if($value == 'Home')
        {
            return $home_status;
        }
        elseif($value == 'Away')
        {
            return $away_status;
        }
    }
    
    public static function points($home_goals, $away_goals, $value)
    {
        if($home_goals == $away_goals)
        {
            $home_points = 1;
            $away_points = 1;
        }
        elseif($home_goals > $away_goals)
        {
            $home_points = 3;
            $away_points = 0;
        }
        elseif($home_goals < $away_goals)
        {
            $home_points = 0;
            $away_points = 3;
        }

        if($value == 'home')
        {
            return $home_points;
        }
        elseif($value == 'away')
        {
            return $away_points;
        }
    }
    
    public static function corner_club($leagues_id, $clubs_id, $value)
    {
        if($value == 'home')
        {
            $over = Fixture::where('leagues_id', $leagues_id)
                    ->where('home_clubs_id', $clubs_id)
                    ->where('home_corners', '>', 4)
                    ->first();
                    
            $under = Fixture::where('leagues_id', $leagues_id)
                    ->where('home_clubs_id', $clubs_id)
                    ->where('home_corners', '<', 5)
                    ->first();
        }
        elseif($value == 'away')
        {
            $over = Fixture::where('leagues_id', $leagues_id)
                    ->where('away_clubs_id', $clubs_id)
                    ->where('away_corners', '>', 4)
                    ->first();
                    
            $under = Fixture::where('leagues_id', $leagues_id)
                    ->where('away_clubs_id', $clubs_id)
                    ->where('away_corners', '<', 5)
                    ->first();
        }

        if(!is_null($over) && is_null($under))
        {
            return 'Over';
        }
        elseif(is_null($over) && !is_null($under))
        {
            return 'Under';
        }    
        elseif(!is_null($over) && !is_null($under))
        {
            return 'Mixed';
        }       
        else
        {
            return null;
        }              
    }
    
    public static function corner_club_all($clubs_id, $value)
    {
        if($value == 'home')
        {
            $over = Fixture::where('home_clubs_id', $clubs_id)
                    ->where('home_corners', '>', 4)
                    ->first();
                    
            $under = Fixture::where('home_clubs_id', $clubs_id)
                    ->where('home_corners', '<', 5)
                    ->first();
        }
        elseif($value == 'away')
        {
            $over = Fixture::where('away_clubs_id', $clubs_id)
                    ->where('away_corners', '>', 4)
                    ->first();
                    
            $under = Fixture::where('away_clubs_id', $clubs_id)
                    ->where('away_corners', '<', 5)
                    ->first();
        }

        if(!is_null($over) && is_null($under))
        {
            return 'Over';
        }
        elseif(is_null($over) && !is_null($under))
        {
            return 'Under';
        }    
        elseif(!is_null($over) && !is_null($under))
        {
            return 'Mixed';
        }       
        else
        {
            return null;
        }              
    }
    
    public static function avg_me($leagues_id, $clubs_id, $value1, $value2)
    {
            return Fixture::where('leagues_id', $leagues_id)
                    ->where($value1.'_clubs_id', $clubs_id)
                    ->avg($value2);  
    }
    
    public static function avg_me_all($clubs_id, $value1, $value2)
    {
        return Fixture::where($value1.'_clubs_id', $clubs_id)
                    ->avg($value2);           
    }
    
    public static function min_max($leagues_id, $clubs_id, $value1, $value2, $value3)
    {
        if($value3 == 'Min')
        {
            return Fixture::where('leagues_id', $leagues_id)
                    ->where($value1.'_clubs_id', $clubs_id)
                    ->min($value2);     
        }
        elseif($value3 == 'Max')
        {
            return Fixture::where('leagues_id', $leagues_id)
                    ->where($value1.'_clubs_id', $clubs_id)
                    ->max($value2);     
        }      
    }
    
    public static function total_points($leagues_id, $clubs_id)
    {
        $total      = 0;

        $temp_1     =   Fixture::where('leagues_id', $leagues_id)
                                ->where('home_clubs_id', $clubs_id)
                                ->where('home_status', 'Win')
                                ->count();     

            if(!is_null($temp_1))
            {
                $total  = $total + ($temp_1 * 3);
            }

        $temp_2     =   Fixture::where('leagues_id', $leagues_id)
                                ->where('home_clubs_id', $clubs_id)
                                ->where('home_status', 'Draw')
                                ->count();     

            if(!is_null($temp_2))
            {
                $total  = $total + $temp_2;
            }

        $temp_3     =   Fixture::where('leagues_id', $leagues_id)
                                ->where('away_clubs_id', $clubs_id)
                                ->where('away_status', 'Win')
                                ->count();     

            if(!is_null($temp_3))
            {
                $total  = $total + ($temp_3 * 3);
            }

        $temp_4     =   Fixture::where('leagues_id', $leagues_id)
                                ->where('away_clubs_id', $clubs_id)
                                ->where('away_status', 'Draw')
                                ->count();     

            if(!is_null($temp_4))
            {
                $total  = $total + $temp_4;
            }

                    
        return $total;
    }


    
    public static function count_wdl($leagues_id, $clubs_id, $value0, $value1, $value2)
    {
        $total      = 0;

        $temp_1     =   Fixture::where('leagues_id', $leagues_id)
                                ->where($value0.'_clubs_id', $clubs_id)
                                ->where($value1, 'like', $value2)
                                ->count();     

        if(!is_null($temp_1))
        {
            $total  = $total + $temp_1;
        }
                    
        return $total;
    }

}
