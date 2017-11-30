<?php namespace Vox\Video\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateVodsTable extends Migration
{
    public function up()
    {
        Schema::create('vox_video_vods', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 128)->unique();
            $table->integer('category_id')->unsigned();
            $table->integer('view_count')->unsigned()->default(0);
            $table->text('downloads');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vox_video_vods');
    }
}
