<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Notifications\Notifiable;

    class Treatment extends Model
    {
        use HasFactory, Notifiable;
        protected $guarded = [];
        public function patient(): BelongsTo
        {
            return $this->belongsTo(Patient::class);
        }
    }
