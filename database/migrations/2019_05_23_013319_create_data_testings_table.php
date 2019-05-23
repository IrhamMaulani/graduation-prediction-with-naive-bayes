<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataTestingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_testings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('student_id');
			$table->string('gender');
			$table->string('dwelling_place');
			$table->string('grade');
			$table->string('high_school_grade_mean');
			$table->string('parents_income');
			$table->string('grad_status');
			$table->string('prediction_grad_status')->nullable();
			$table->integer('batch');
			$table->float('ontime_grade', 10, 0)->nullable();
			$table->float('late_grad', 10, 0)->nullable();
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
		Schema::drop('data_testings');
	}

}
