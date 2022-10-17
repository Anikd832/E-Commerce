<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('category_id');
            $table->string('product_name');
            $table->text('product_short_description');
            $table->longText('product_long_description');
            $table->integer('product_regular_price');
            $table->integer('product_discounted_price');
            $table->longText('product_additional_information');
            $table->integer('product_quantity');
            $table->string('product_thumbnail_photo')->default('product_thumbnail_photo.jpg');
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
