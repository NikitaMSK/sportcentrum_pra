<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Les extends Model
{
    protected $table = 'lessen';

    protected $fillable = [
        'datum',
        'tijd',
        'activiteit',
        'trainer_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'datum' => 'date',
        ];
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }

    public function aanmeldingen(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'les_aanmeldingen',
            'les_id',
            'user_id'
        );
    }


}