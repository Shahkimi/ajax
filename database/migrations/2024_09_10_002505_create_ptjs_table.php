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
        Schema::create('ptjs', function (Blueprint $table) {
            $table->id();
            $table->string('kod_ptj')->unique();
            $table->string('desc_ptj');
            $table->string('ketua_ptj');
            $table->text('alamat_ptj');
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
        Schema::dropIfExists('ptjs');
    }
};
