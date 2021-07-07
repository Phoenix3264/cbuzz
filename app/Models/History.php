<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'leagues_id',
        'round_league',
        'code_match',
        'teams_id',
        'type',
        'goals',
        'avg_goals',
        'corners',
        'avg_corners',
        'status'
    ];

    protected $hidden = ["deleted_at"];
}
