<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateCategoryProductPivotTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('category_product', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->index();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->unsignedBigInteger('product_id')->index();
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->primary(['category_id', 'product_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('category_product');
        }
    }
