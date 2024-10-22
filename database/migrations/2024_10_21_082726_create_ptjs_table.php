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
        Schema::create('ptjs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ptj');
            $table->unsignedInteger('kod_ptj');
            $table->text('alamat');
            $table->string('pengarah');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bahagians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ptj_id')->constrained('ptjs')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahagian_id')->constrained('bahagians')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
        Schema::dropIfExists('bahagians');
        Schema::dropIfExists('ptjs');
    }
};
