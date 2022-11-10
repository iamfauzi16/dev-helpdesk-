<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesReportsTable extends Migration
{
    public function up()
    {
        Schema::create('attendances_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->date('date_time')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
