<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsToMany;
	use Illuminate\Notifications\Notifiable;

	class Animal extends Model
	{
		use HasFactory, Notifiable;

		protected $guarded = [];
		protected $casts = [
			'raza' => 'array',
		];

		public function raza(): BelongsToMany
		{
			return $this->belongsToMany(Raza::class);
		}
	}
