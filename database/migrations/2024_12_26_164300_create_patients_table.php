<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
                $table->id();
                $table->date('date_of_birth')->nullable();
                $table->string('name');
                $table->string('photo')->nullable();
                $table->enum('gender', ['Macho', 'Hembra'])->nullable();
                $table->bigInteger('user_id');
                $table->bigInteger('animal_id');
                $table->bigInteger('raza_id');
                $table->bigInteger('owner_id');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
