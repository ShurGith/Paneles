<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Notifications\Notifiable;

    class Patient extends Model
    {
        use HasFactory, Notifiable;

        protected $guarded = [];

        public function owner(): BelongsTo
        {
            return $this->belongsTo(Owner::class);
        }

      /*  public function user(): HasMany
        {//Veterinarios
            return $this->hasMany(User::class);
        }*/

        public function animal(): BelongsTo
        {
            return $this->belongsTo(Animal::class);
        }

        public function raza(): BelongsTo
        {
            return $this->belongsTo(Raza::class);
        }

        public function treatment(): HasMany
        {
            return $this->hasMany(Treatment::class);
        }
    }
