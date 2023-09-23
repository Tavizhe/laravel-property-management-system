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
        Schema::create('form_for_us', function (Blueprint $table) {
            $table->id();
            $table->string('owner')->nullable();
            $table->string('phone')->nullable();
            $table->string('onvan')->nullable();
            $table->string('status')->nullable();
            $table->string('price')->nullable();
            $table->string('rooms')->nullable();
            $table->text('tozihat')->nullable();
            $table->string('masahat')->nullable();
            $table->string('zirbana')->nullable();
            $table->string('jahat')->nullable();
            $table->string('nama')->nullable();
            $table->string('sanad')->nullable();
            $table->text('adress')->nullable();
            $table->text('tozihat2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};