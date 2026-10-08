<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Trainer;

class Les extends Model
{
    protected $table = 'lessen';

    protected $fillable = [
        'datum',
        'tijd',
        'activiteit',
        'trainer_id',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}