<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreatePostTagPivotTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('post_tag', function (Blueprint $table) {
                $table->unsignedBigInteger('post_id')->index();
                $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
                $table->unsignedBigInteger('tag_id')->index();
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
                $table->primary(['post_id', 'tag_id']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('post_tag');
        }
    }
