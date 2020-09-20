<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product')->unsigned();
            $table->foreign('product')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->bigInteger('shop')->unsigned();
            $table->foreign('shop')
                ->references('id')
                ->on('shops')
                ->onDelete('cascade');
            $table->integer('qty')->default(0);    
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
        Schema::dropIfExists('sales');
    }
}
