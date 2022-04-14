<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'package_id',
        'name',
        'type',
        'path',
        'type_file'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function package() {
        return $this->belongsTo(Package::class);
    }
}
