<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductsForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $table->unsignedBigInteger('productID')->change();
        // $table->unsignedBigInteger('categoryID')->change();

        Schema::table('categoryProducts', function (Blueprint $table) {
            $table->foreign('productID')->references('id')->on('products');
            $table->foreign('categoryID')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categoryProducts', function (Blueprint $table) {
            $table->dropForeign(['productID']);
            $table->dropForeign(['categoryID']);
        });
    }
}
