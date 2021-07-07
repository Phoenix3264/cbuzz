<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class League extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'nama',
        'tahun',
        'countries_id'
    ];

    protected $hidden = ["deleted_at"];
}
