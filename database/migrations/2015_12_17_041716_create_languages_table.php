<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function($table) {
            $table->increments("id");
            $table->string("lang_code", 255);
            $table->string("title", 255);
            $table->string("alias", 255);
            $table->integer("template_id")->unsigned();
            $table->foreign("template_id")->references("id")->on("templates")->onUpdate("cascade")->onDelete("cascade");
            $table->tinyInteger("default")->default(0);
            $table->tinyInteger("public")->default(1);
            $table->text("perm");
            $table->text("attribs");
            $table->unique('alias');
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
        Schema::dropIfExists('languages');
    }

}
