<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailProductTable extends Migration
{
    public function up()
    {
        Schema::create('detail_product', function (Blueprint $table) {
            $table->id();
            $table->integer('detail_id');
            $table->integer('product_id');
            $table->string('value');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_product');
    }
}
