<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Raw_club_league extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'leagues_id',
        'round_league',
        'raw_text',
        'post_raw_text',
    ];

    protected $hidden = ["deleted_at"];
}
