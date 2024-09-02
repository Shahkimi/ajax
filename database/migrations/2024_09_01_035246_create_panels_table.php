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
        Schema::create('panels', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengurusi');
            $table->string('mpm_pengurusi');
            $table->string('nama_panel');
            $table->string('nama_panel2');
            $table->string('mpm_panel2');
            $table->string('jawatan_panel2');
            $table->string('tajuk_panel2');
            $table->string('penyemak');
            $table->string('jawatan_penyemak');
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
        Schema::dropIfExists('panels');
    }
};
