<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('routes', function($table) {
                $table->increments("id");
                $table->string("name", 255);
                $table->string("alias", 255);
                $table->string("ctrl", 255);
                $table->string("location", 50)->default("site");
                $table->integer("extension_id")->unsigned();
                $table->foreign("extension_id")->references("id")->on("extensions")->onUpdate("cascade")->onDelete("cascade");
                $table->text("perm");
                $table->text("attribs");
                $table->tinyInteger("show_menu");
                $table->tinyInteger("protected")->default(0);
                $table->unique('alias');
                $table->unique('ctrl');
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
            Schema::dropIfExists('extensions');
	}

}
