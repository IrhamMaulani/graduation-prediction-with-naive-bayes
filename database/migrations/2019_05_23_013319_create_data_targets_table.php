<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_targets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('student_id');
			$table->string('gender');
			$table->string('dwelling_place');
			$table->string('grade');
			$table->string('high_school_grade_mean');
			$table->string('parents_income');
			$table->string('grad_prediction');
			$table->timestamps();
			$table->integer('testing_trial_id')->unsigned()->index('testing_trial_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_targets');
	}

}
