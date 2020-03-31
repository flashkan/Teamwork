<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('seller_id')->unsigned();
            $table->decimal('start_price', 15, 2);
            $table->decimal('buyback_price', 15, 2)->default(null)->nullable();
            $table->dateTime('end_time');
            $table->decimal('current_rate', 15, 2)->default(0);
            $table->bigInteger('current_buyer_id')->unsigned()->default(null)->nullable();
            $table->boolean('closed')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lots');
    }
}
