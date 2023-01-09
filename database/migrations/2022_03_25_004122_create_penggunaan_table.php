<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunaan', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_barang')->constrained('barang_inventaris');
            $table->string('nama', 100);
            $table->double('qty');
            $table->double('harga');
            $table->dateTime('waktu_beli');
            $table->string('supplier', 100);
            $table->enum('status', ['diajukan_beli', 'habis', 'tersedia']);
            $table->dateTime('update_status')->nullable();
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
        Schema::dropIfExists('penggunaan');
    }
}
