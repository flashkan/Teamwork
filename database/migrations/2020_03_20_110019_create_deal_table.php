<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->decimal('price', 15, 2);
            $table->dateTime('end_time');
            $table->decimal('current_rate', 15, 2);
            $table->bigInteger('current_buyer_id')->unsigned();
            $table->boolean('closed');
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
        Schema::dropIfExists('deal');
    }
}
