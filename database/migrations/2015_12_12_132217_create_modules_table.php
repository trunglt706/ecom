<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('modules', function($table) {
            $table->increments("id");
            $table->string("name", 255);
            $table->text("description");
            $table->integer("extension_id")->unsigned();
            $table->foreign("extension_id")->references("id")->on("extensions")->onUpdate("cascade")->onDelete("cascade");
            $table->text("attribs");
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
            Schema::dropIfExists('modules');
	}

}
