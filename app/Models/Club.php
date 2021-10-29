<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'nama',
        'countries_id',

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

        'home_corner_club',
        'away_corner_club',
    ];

    protected $hidden = ["deleted_at"];


    public static function update_calibrate($clubs_id)
    {

    }

    public static function Postmatch($clubs_id)
    {
        $total_avg_home_goals = fixture::avg_me_all($clubs_id, 'home', 'home_goals');
        $total_avg_away_goals = fixture::avg_me_all($clubs_id, 'away', 'away_goals');

        $total_avg_home_corners = fixture::avg_me_all($clubs_id, 'home', 'home_corners');
        $total_avg_away_corners = fixture::avg_me_all($clubs_id, 'away', 'away_corners');

        $home_corner_club = fixture::corner_club_all($clubs_id, 'home');
        $away_corner_club = fixture::corner_club_all($clubs_id, 'away');

        Club::where('id', $clubs_id)
                        ->update([
                            'total_avg_home_goals'      => $total_avg_home_goals,
                            'total_avg_away_goals'      => $total_avg_away_goals,
                            'total_avg_home_corners'    => $total_avg_home_corners,
                            'total_avg_away_corners'    => $total_avg_away_corners,
                            'home_corner_club'          => $home_corner_club,
                            'away_corner_club'          => $away_corner_club
                        ]);
    }
}
