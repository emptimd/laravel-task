<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyOderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_product', function(Blueprint $table)
        {
            $table->string('product_name')->nullable();
            $table->decimal('product_price', 8, 2)->default(0);
            $table->unsignedSmallInteger('qty')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product', function(Blueprint $table)
        {
            $table->dropColumn('qty');
        });
    }
}
