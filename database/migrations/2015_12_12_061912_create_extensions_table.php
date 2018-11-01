<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtensionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensions', function($table) {
            $table->increments("id");
            $table->string("name", 255);
            $table->string("type", 50);
            $table->string("location", 50)->default("site");
            $table->string("author", 255);
            $table->string("creation_date", 255);
            $table->string("copyright", 255);
            $table->string("license", 255);
            $table->string("author_email", 255);
            $table->string("author_url", 255);
            $table->string("version", 255);
            $table->string("description", 255);
            $table->tinyInteger("public")->default(1);
            $table->text("attribs");
            $table->tinyInteger("protected")->default(0);
            $table->unique('name');
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
