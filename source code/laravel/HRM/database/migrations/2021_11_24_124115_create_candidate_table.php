<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate', function (Blueprint $table) {
            $table->increments('CANDIDATEID');

            $table->string('EMPID',50);
            $table->foreign('EMPID')->references('EMPID')->on('employee');
            $table->string('DEPTID',50);
            $table->foreign('DEPTID')->references('DEPTID')->on('department');
            $table->string('ACAID',50);
            $table->foreign('ACAID')->references('ACAID')->on('academy');
            $table->string('BRANCHID',50);
            $table->foreign('BRANCHID')->references('BRANCHID')->on('branch');
            $table->string('TITLEID',50);
            $table->foreign('TITLEID')->references('TITLEID')->on('title');
            $table->string('POSID',50);
            $table->foreign('POSID')->references('POSID')->on('position');

            $table->string('FULLNAME',100);
            $table->date('BDATE');
            $table->string('ADDRESS',100);
            $table->string('SEX',10);
            $table->string('IDCARD',12);
            $table->string('STATUS',50);
            $table->string('AVT',50);
            $table->date('INTERVIEWDATE');
            $table->string('EMAIL',50);
            $table->string('PHONE',12);
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
        Schema::dropIfExists('candidate');
    }
}
