<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyDealToUserAndProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deal', function (Blueprint $table) {
            $table->foreign('current_buyer_id')
                ->on('users')
                ->references('id');
            $table->foreign('product_id')
                ->on('product')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deal', function (Blueprint $table) {
            $table->dropForeign(['current_buyer_id']);
            $table->dropForeign(['product_id']);
        });
    }
}
