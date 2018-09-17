<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderTableAddPaymentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table)
        {
            $table->unsignedTinyInteger('payment_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down()
    {
        return true;
    }
}
