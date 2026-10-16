<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LesAanmelding extends Model
{
    protected $table = 'les_aanmeldingen';

    protected $fillable = [
        'user_id',
        'les_id',
    ];

    public function les()
    {
        return $this->belongsTo(Les::class, 'les_id');
    }

    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
