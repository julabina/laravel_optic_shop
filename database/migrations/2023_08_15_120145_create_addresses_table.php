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
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->string('address1');
            $table->string('address2');
            $table->string('postalcode');
            $table->string('city');
            $table->boolean('deliverySameAddress')->default(true);
            $table->string('deliveryAddress1')->nullable();
            $table->string('deliveryAddress2')->nullable();
            $table->string('deliveryPostalcode')->nullable();
            $table->string('deliveryCity')->nullable();
            $table->boolean('isCompany')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
