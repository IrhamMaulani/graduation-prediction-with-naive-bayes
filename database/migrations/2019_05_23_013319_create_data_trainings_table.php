<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataTrainingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_trainings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('student_id');
			$table->string('gender');
			$table->string('dwelling_place');
			$table->string('grade');
			$table->string('high_school_grade_mean');
			$table->string('parents_income');
			$table->string('grad_status');
			$table->timestamps();
			$table->integer('batch')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_trainings');
	}

}
