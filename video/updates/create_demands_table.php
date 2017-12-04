<?php namespace Vox\Video\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateDemandsTable extends Migration
{
    public function up()
    {
        Schema::create('vox_video_demands', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 128)->unique();
            $table->integer('count')->unsigned()->default(1);
            $table->string('from', 32);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vox_video_demands');
    }
}
