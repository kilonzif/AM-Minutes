<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meeting_id')->unsigned();
            $table->bigInteger('participant_id')->unsigned();
            $table->foreign('meeting_id')->references('id')->on('minutes')->onDelete('cascade');
            $table->foreign('participant_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('meeting_participants');
    }
}
