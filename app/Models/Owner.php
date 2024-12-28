<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\PseudoTypes\TraitString;

class Owner extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];
    public function treatment(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }
    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
}
