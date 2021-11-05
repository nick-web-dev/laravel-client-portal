<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('author')->nullable();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('media')->nullable();
            $table->string('action_link')->nullable();
            $table->string('action_text')->nullable();
            $table->string('status');
            $table->datetime('publish_start_date')->nullable();
            $table->datetime('publish_end_date')->nullable();
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
        Schema::dropIfExists('announcements');
    }
}
