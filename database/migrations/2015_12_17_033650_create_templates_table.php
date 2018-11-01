<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('templates', function($table) {
                $table->increments("id");
                $table->integer("extension_id")->unsigned();
                $table->foreign("extension_id")->references("id")->on("extensions")->onUpdate("cascade")->onDelete("cascade");
                $table->text("layout");
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
		Schema::dropIfExists('templates');
	}

}
