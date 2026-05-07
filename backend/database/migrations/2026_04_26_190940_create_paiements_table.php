<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->enum('methode', ['carte', 'especes', 'virement', 'mobile_money']);
            $table->enum('statut', ['en_attente', 'paye', 'rembourse'])->default('en_attente');
            $table->string('reference')->nullable();
            $table->timestamp('paye_le')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};