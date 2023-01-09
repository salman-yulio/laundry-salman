<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjemputanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjemputan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_member')->constrained('member');
            $table->string('petugas', 120);
            $table->enum('status', ['tercatat', 'penjemputan', 'selesai']);
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
        Schema::dropIfExists('penjemputan');
    }
}
