<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bet_accuracy extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'nama'
    ];

    protected $hidden = ["deleted_at"];
}
