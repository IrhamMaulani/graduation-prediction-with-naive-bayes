<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDataTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('data_targets', function(Blueprint $table)
		{
			$table->foreign('testing_trial_id', 'data_targets_ibfk_1')->references('id')->on('testing_trials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('data_targets', function(Blueprint $table)
		{
			$table->dropForeign('data_targets_ibfk_1');
		});
	}

}
