<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_statistical', function (Blueprint $table) {
            $table->increments('id_statistical');
            $table->date('order_date');
            $table->decimal('sales', 15, 2);
            $table->decimal('profit', 15, 2);
            $table->bigInteger('quantity');
            $table->bigInteger('total_order');
        });
    }

    public function down() {
        Schema::dropIfExists('tbl_statistical');
    }
};
