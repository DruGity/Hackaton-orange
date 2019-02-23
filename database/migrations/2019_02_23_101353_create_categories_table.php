<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->integer('user_create_id');
            $table->integer('user_update_id');
            $table->integer('user_create_id')->unsigned()->nullable();
            $table->integer('user_update_id')->unsigned()->nullable();
            $table->timestamps();

        });

        Schema::table('categories', function($table) {
            $table->foreign('user_create_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_update_id')->references('id')->on('users')->onDelete('set null');
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
