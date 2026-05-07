<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->enum('type', ['simple', 'double', 'suite', 'familiale']);
            $table->decimal('prix_par_nuit', 8, 2);
            $table->integer('capacite');
            $table->text('description')->nullable();
            $table->enum('statut', ['disponible', 'occupee', 'maintenance'])->default('disponible');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};