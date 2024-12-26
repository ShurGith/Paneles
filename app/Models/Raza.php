<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Notifications\Notifiable;

    class Raza extends Model
    {
        use HasFactory, Notifiable;

        
        protected $guarded = [];

        public function animal(): HasOne
        {
            return $this->hasOne(Animal::class);
        }
    }
