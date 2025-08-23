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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->json('brands')->nullable();
            $table->json('models')->nullable();
            $table->json('versions')->nullable();
            $table->json('years_model')->nullable();
            $table->json('years_build')->nullable();
            $table->json('colors')->nullable();
            $table->json('fuels')->nullable();
            $table->json('transmissions')->nullable();
            $table->json('doors')->nullable();
            $table->json('units')->nullable();
            $table->json('km')->nullable(); 
            $table->json('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
