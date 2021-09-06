<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateCategoryPostPivotTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('category_post', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->index();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->unsignedBigInteger('post_id')->index();
                $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
                $table->primary(['category_id', 'post_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('category_post');
        }
    }
