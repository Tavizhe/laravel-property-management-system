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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('pType_id');
            $table->string('amenities_id');
            $table->string('property_name');
            $table->string('property_slug');
            $table->string('property_code');
            $table->string('property_status');
            $table->string('lowest_price')->nullable();
            $table->string('rent')->nullable();
            $table->string('house_mortgage')->nullable();
            $table->string('property_thumbnail');
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('garage')->nullable();
            $table->string('foundation_size')->nullable();
            $table->string('property_size')->nullable();
            $table->string('property_video')->nullable();
            $table->string('address')->nullable();
            // $table->string('city')->nullable();
            // $table->string('state')->nullable();
            // $table->string('postal_code')->nullable();
            // $table->string('neighborhood')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('featured')->nullable();
            $table->string('hot')->nullable();
            $table->integer('agent_id')->nullable();
            $table->integer('tedadTabaghe')->nullable();
            $table->integer('tedadKoleTabaghat')->nullable();
            $table->integer('TabagheDarVahed')->nullable();
            $table->integer('VaziatBana')->nullable();
            $table->integer('Jahat')->nullable();
            $table->integer('nama')->nullable();
            $table->integer('KafPush')->nullable();
            $table->integer('ServiceKitchen')->nullable();
            $table->integer('VorudiMoshtarak')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};