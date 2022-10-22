<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->string('EMPID',50)->primary();
            
            $table->string('ETHNICID',50);
            $table->foreign('ETHNICID')->references('ETHNICID')->on('ethnic');
            $table->string('RELIGIONID',50);
            $table->foreign('RELIGIONID')->references('RELIGIONID')->on('religion');
            $table->string('NATIONID',50);
            $table->foreign('NATIONID')->references('NATIONID')->on('nationality');
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
            $table->string('SALARYID',50);
            $table->foreign('SALARYID')->references('SALARYID')->on('salary');

            $table->string('FULLNAME',100);
            $table->date('BDATE');
            $table->string('MANAGERID',50);
            $table->string('ADDRESS',100);
            $table->string('SEX',10);
            $table->string('IDCARD',12);
            $table->string('INSURANCE',20);
            $table->string('STATUS',50);
            $table->string('AVT',50);
            $table->date('STARTDATE');
            $table->date('ENDDATE');
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
        Schema::dropIfExists('employee');
    }
}
