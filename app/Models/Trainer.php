<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trainer extends Model
{
    protected $table = 'trainers';

    protected $fillable = [
        'naam',
    ];

    public function lessen(): HasMany
    {
        return $this->hasMany(Les::class);
    }
}