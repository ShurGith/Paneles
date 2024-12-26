<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Notifications\Notifiable;

    class Raza extends Model
    {
        use HasFactory, Notifiable;

        protected $guarded = [];

//        public function animal(): BelongsTo
//        {
//            return $this->belongsTo(Animal::class);
//        }
    }
