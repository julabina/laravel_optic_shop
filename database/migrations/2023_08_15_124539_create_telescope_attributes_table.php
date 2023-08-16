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
        Schema::create('telescope_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_id');
            $table->enum('type', [
                'telescope Schmidt-Cassegrain',
                'lunette achromatique',
                'lunette apochromatique',
                'telescope Newton',
                'telescope  edge HD',
                'telescope Maksutov',
            ])->default('telescope Newton');
            $table->integer('diameter');
            $table->integer('focalLength');
            $table->string('mount')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telescope_attributes');
    }
};
