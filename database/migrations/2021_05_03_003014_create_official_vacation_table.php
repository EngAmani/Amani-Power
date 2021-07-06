<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialVacationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //for admin to add official vacation
    public function up()
    {
        Schema::create('official_vacation', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('start');
            $table->date('end');
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
        Schema::dropIfExists('official_vacation');
    }
}
