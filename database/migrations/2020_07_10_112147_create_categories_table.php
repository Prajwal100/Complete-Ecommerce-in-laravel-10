<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateCategoriesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('title')->index();
                $table->string('slug')->index();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->foreign('parent_id')->references('id')->on('categories');
                $table->integer('_lft')->nullable();
                $table->integer('_rgt')->nullable();
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
            Schema::dropIfExists('categories');
        }
    }
