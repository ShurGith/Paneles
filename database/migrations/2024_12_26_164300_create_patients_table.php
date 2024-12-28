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
                //Relaciones
                $table->unsignedInteger('owner_id');
                $table->unsignedInteger('animal_id');
                $table->unsignedInteger('raza_id');
                $table->unsignedInteger('treatment_id')->nullable();
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
