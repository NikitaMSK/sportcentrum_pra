<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * De lesaanmeldingen van deze gebruiker.
     */
    public function lesAanmeldingen(): HasMany
    {
        return $this->hasMany(LesAanmelding::class);
    }

    public function trainer(): HasOne
    {
        return $this->hasOne(Trainer::class, 'naam', 'name');
    }

    public function isTrainer(): bool
    {
        return $this->trainer()->exists();
    }

    /**
     * De attributen die gecast moeten worden.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
