<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minutes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organizer_id')->unsigned();
            $table->string('meeting_title');
            $table->string('purpose');
            $table->string('organization');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->longText('meeting_notes');
            $table->foreign('organizer_id')->references('id')->on('users');
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
        Schema::dropIfExists('minutes');
    }
}
