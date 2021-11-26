<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index('slug_index')->nullable();
            $table->text('content')->nullable();
            $table->biginteger('created_user_id')->nullable();
            // $table->foreign('user_id)->references('id')->on('users');
            $table->string('cover')->nullable();
            $table->string("publish_date");
            $table->tinyInteger('is_verifited')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('blogs');
    }
}
