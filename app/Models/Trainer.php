<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $table = 'trainers';

    protected $fillable = [
        'naam',
    ];

    public function lessen()
    {
        return $this->hasMany(Les::class);
    }
}