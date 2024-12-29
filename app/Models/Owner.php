<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasManyThrough;
    use Illuminate\Notifications\Notifiable;

    class Owner extends Model
    {
        use HasFactory, Notifiable;

        protected $guarded = [];

        public function treatment(): HasManyThrough
        {
            return $this->hasManyThrough(Treatment::class, Patient::class);
        }

        public function patient(): HasMany
        {
            return $this->hasMany(Patient::class);
        }
    }
