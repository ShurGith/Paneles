<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Notifications\Notifiable;

    class Animal_Raza extends Model
    {
        use HasFactory, Notifiable;

        protected $guarded = [];

        public function animal(): HasMany
        {
            return $this->hasMany(Animal::class);
        }

        public function raza(): HasMany
        {
            return $this->hasMany(Raza::class);
        }
    }
