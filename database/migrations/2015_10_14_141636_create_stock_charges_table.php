<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('stock_charges', function (Blueprint $table) {

            $table->increments('id');
            $table->string('code');
            $table->string('status');


            $table->morphs('documentable');

            $table->string('desc');


            $table->integer('warehouse_id')->unsigned();
            $table->foreign('warehouse_id')->references('id')->on('warehouses');

            $table->integer('organization_id')->unsigned();
            $table->foreign('organization_id')->references('id')->on('organizations');

            $table->decimal('weight', 10, 2)->nullable()->unsigned();
            $table->decimal('volume', 10, 2)->nullable()->unsigned();

            $table->decimal('total', 20, 2);  //общая стоимость прихода
        });



        Schema::create('stock_charge_items', function (Blueprint $table) {


            $table->increments('id');


            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('stock_id')->unsigned();
            $table->foreign('stock_id')->references('id')->on('stocks');

            $table->integer('charge_id')->unsigned();
            $table->foreign('charge_id')->references('id')->on('stock_charges');





            $table->decimal('price', 20, 2);
            $table->decimal('qty', 20, 4);


            $table->decimal('weight', 10, 2)->nullable()->unsigned();
            $table->decimal('volume', 10, 2)->nullable()->unsigned();



            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stock_charge_items');
        Schema::drop('stock_charges');
    }
}
