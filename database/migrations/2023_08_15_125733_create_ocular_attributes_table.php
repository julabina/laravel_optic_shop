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
        Schema::create('ocular_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_id');
            $table->enum('model', [
                'Plössl',
                'Super Plössl',
                'DeLite',
                'Lanthanum',
                'Delos',
                'edge-On',
                'Hyperion',
                'Ethos',
                '82°',
                'Luminos',
                'X-cel',
                '100°',
                '68°',
                'XW',
                'Nagler',
            ])->default('Plössl');
            $table->integer('focalLength');
            $table->integer('fov');
            $table->integer('eyeRelief');
            $table->integer('size');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocular_attributes');
    }
};
