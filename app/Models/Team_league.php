<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team_league extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'leagues_id',
        'teams_id'
    ];

    protected $hidden = ["deleted_at"];
}
