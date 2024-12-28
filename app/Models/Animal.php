<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Notifications\Notifiable;

    class Animal extends Model
    {
        use HasFactory, Notifiable;

        protected $guarded = [];
        protected $casts = [
            //   'raza' => 'array',
        ];

        public function raza(): HasMany
        {
            return $this->HasMany(Raza::class);
        }
        public function patient(): HasMany
        {
            return $this->hasMany(Patient::class);
        }
    }
