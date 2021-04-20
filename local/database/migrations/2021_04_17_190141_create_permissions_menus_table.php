<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roles_id')->unsigned();
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('Cascade');
            $table->integer('menus_id')->unsigned();
            $table->foreign('menus_id')->references('id')->on('roles')->onDelete('Cascade');
            $table->string('permissions');
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
        Schema::drop('permissions_menus');
    }
}
