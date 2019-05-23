<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestingTrialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testing_trials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('accuracy_data')->nullable();
			$table->string('recall_data')->nullable();
			$table->string('precision_data')->nullable();
			$table->integer('batch');
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
		Schema::drop('testing_trials');
	}

}
