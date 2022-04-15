<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Package extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'code_tracking',
        'position_id',
        'cep',
        'road', 
        'number',
        'district',
        'complement',
        'state',
        'city'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function positions(){
        return $this->belongsTo(Position::class,'position_id');
    }

    public function uploads() {
        return $this->hasMany(Upload::class);
    }

    public function positionsLog() {
        return $this->belongsToMany(Position::class, 'log_positions');
    }
}
