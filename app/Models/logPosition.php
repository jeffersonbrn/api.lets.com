<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class logPosition extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'package_id',
        'position_id'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
