<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->text('description');
            $table->string('product_image');
            $table->string('price');
            $table->string('price_per_unit');
            $table->string('category_id');
            $table->string('quantity');
            $table->string('made_in_nigeria');
            $table->string('discount')->nullable();
            $table->string('ordered_quantities')->nullable();
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
        Schema::dropIfExists('products');
    }
}
