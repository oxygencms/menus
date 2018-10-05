<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique()->index();
            $table->string('class')->nullable();
            $table->string('children_class')->nullable();
            $table->json('attrs')->nullable();
            $table->boolean('active')
                  ->default(1)
                  ->index();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');

            $table->json('text');
            $table->json('title')->nullable();
            $table->string('url')->nullable();
            $table->string('route')->nullable();
            $table->string('action')->nullable();
            $table->json('params')->nullable();
            $table->json('attrs')->nullable();
            $table->json('parent_attrs')->nullable();
            $table->string('class')->nullable();
            $table->string('parent_class')->nullable();
            $table->boolean('_blank')->default(0);
            $table->boolean('active')->default(1);
            $table->integer('order_id')->nullable();

            $table->unsignedInteger('menu_id')->index();
            $table->foreign('menu_id')
                  ->references('id')->on('menus')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('links');
        Schema::dropIfExists('menus');
    }
}
