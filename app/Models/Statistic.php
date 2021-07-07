<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statistic extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'leagues_id',
        'round_league',

        'home_teams_id',
        'away_teams_id',

        'home_goals',
        'away_goals',

        'home_hdp_goals',
        'away_hdp_goals',

        'home_avg_goals',
        'away_avg_goals',

        'over_under_goals',

        'hdp_goals_status',
        'ou_goals_status',

        'home_corners',
        'away_corners',

        'home_hdp_corners',
        'away_hdp_corners',

        'home_avg_corners',
        'away_avg_corners',

        'over_under_corners',

        'min_corners',
        'max_corners',

        'ou_corners_status',

        'my_bet',
        'bet_status'
    ];

    protected $hidden = ["deleted_at"];
}

/*
leagues_id  
round_league

home_teams_id
away_teams_id

home_goals
away_goals
home_hdp_goals
away_hdp_goals
home_avg_goals
away_avg_goals
over_under_goals
hdp_goals_status
ou_goals_status
home_corners
away_corners
home_hdp_corners
away_hdp_corners
home_avg_corners
away_avg_corners
over_under_corners
ou_corners_status
my_bet
bet_status
*/