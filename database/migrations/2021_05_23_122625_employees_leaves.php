<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeesLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leaves', function (Blueprint $table) { 
        $table->id();
        $table->bigInteger('user_id')->unsigned();
        $table->string('title');
        $table->date('start');
        $table->date('end');
        $table->string('file_name')->nullable();
        $table->string('file_path')->nullable();
        $table->boolean('approved')->default(0);
        $table->foreign('user_id')->references('id')->on('users');
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

        Schema::dropIfExists('employee_leaves');    }
}
