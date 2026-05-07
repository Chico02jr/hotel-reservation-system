<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_service', function (Blueprint $table) {
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->integer('quantite')->default(1);
            $table->primary(['reservation_id', 'service_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_service');
    }
};