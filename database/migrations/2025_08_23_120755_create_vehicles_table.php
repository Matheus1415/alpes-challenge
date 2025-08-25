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
            $table->string('type');
            $table->string('brand'); 
            $table->string('model');
            $table->string('version')->nullable(); 
            $table->string('year_model')->nullable();
            $table->string('year_build')->nullable(); 
            $table->json('optionals')->nullable();
            $table->unsignedTinyInteger('doors')->nullable();
            $table->string('board')->nullable();
            $table->string('chassi')->nullable();
            $table->string('transmission')->nullable(); 
            $table->integer('km')->nullable();
            $table->text('description')->nullable();
            $table->boolean('sold')->default(false); 
            $table->string('category')->nullable();
            $table->string('url_car')->nullable(); 
            $table->decimal('old_price', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('color')->nullable();
            $table->string('fuel')->nullable();
            $table->json('fotos')->nullable();
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
