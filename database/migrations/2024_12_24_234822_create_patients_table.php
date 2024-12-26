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
            Schema::create('patients', function (Blueprint $table) {
                $table->id();
                $table->date('date_of_birth')->nullable();
                $table->string('name');
                $table->string('photo')->nullable();
                $table->enum('gender', ['Macho', 'Hembra'])->nullable();
                $table->foreignId('animal_id')->index()->constrained('animals')->cascadeOnDelete();
                $table->foreignId('raza_id')->index()->constrained('owners')->cascadeOnDelete();
                $table->foreignId('user_id')->index()->constrained('users')->cascadeOnDelete();
                $table->foreignId('owner_id')->index()->constrained('owners')->cascadeOnDelete();
                //$table->json('raza_id')->nullable();
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
