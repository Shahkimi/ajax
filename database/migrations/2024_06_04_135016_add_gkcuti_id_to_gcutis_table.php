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
        Schema::table('gcutis', function (Blueprint $table) {
            $table->dropColumn('kategori_cuti');
            $table->foreignId('gkcuti_id')->constrained()->index()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gcutis', function (Blueprint $table) {
            $table->dropForeign(['gkcuti_id']);
            $table->dropColumn('gkcuti_id');
            $table->string('kategori_cuti', 255);
        });
    }
};
