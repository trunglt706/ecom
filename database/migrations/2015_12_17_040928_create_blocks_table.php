<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('blocks', function($table) {
            $table->increments("id");
            $table->string("title", 255);
            $table->text("content");
            $table->string("position", 255);
            $table->integer("module_id")->unsigned();
            $table->foreign("module_id")->references("id")->on("modules")->onUpdate("cascade")->onDelete("cascade");
            $table->tinyInteger("public")->default(1);
            $table->integer("sort")->unsigned();
            $table->text("assignment");
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
            Schema::dropIfExists('blocks');
	}

}
