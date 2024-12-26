<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('animal_raza', function (Blueprint $table) {
                $table->id();
                $table->foreignId('animal_id')->constrained('animals')->cascadeOnDelete();
                $table->foreignId('raza_id')->constrained('razas')->cascadeOnDelete();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('animals_razas');
        }
    };
