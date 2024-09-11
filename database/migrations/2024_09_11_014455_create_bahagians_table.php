<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahagians', function (Blueprint $table) {
            $table->string('kod_bahagian', 10)->primary();
            $table->string('kod_ptj', 10);
            $table->foreign('kod_ptj')->references('kod_ptj')->on('ptjs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahagians');
    }
};
