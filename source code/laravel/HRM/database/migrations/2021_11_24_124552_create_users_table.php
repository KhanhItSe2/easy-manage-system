<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('EMPID',50);
            $table->string('USERNAME',50);
            $table->foreign('EMPID')->references('EMPID')->on('employee');
            $table->string('ROLEID',50);
            $table->foreign('ROLEID')->references('ROLEID')->on('role');
            $table->string('PASSWORD',255);
            $table->string('AVT',50);
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
        Schema::dropIfExists('users');
    }
}
