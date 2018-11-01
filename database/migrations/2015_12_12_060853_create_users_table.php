<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('users', function($table) {
                $table->increments("id");
                $table->text("profile_pic");
                $table->string("fullname", 255);
                $table->string("gender", 255);
                $table->string("phone", 255);
                $table->string("email", 255);
                $table->string("address", 255);
                $table->string("username", 255);
                $table->string("password", 255);
                $table->string("remember_token", 100);
                $table->integer("user_group_id")->unsigned();
                $table->foreign("user_group_id")->references("id")->on("user_groups")->onUpdate("cascade")->onDelete("cascade");
                $table->tinyInteger('active');
                $table->text('note');
                $table->text("attribs");
                $table->timestamp('last_login');
                $table->unique('username');
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
            Schema::dropIfExists('users');
	}

}
