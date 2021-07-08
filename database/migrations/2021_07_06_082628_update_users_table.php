<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class UpdateUsersTable extends Migration
{
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $blueprint) {
			$blueprint->renameColumn('name', 'first_name');
			$blueprint->tinyText('last_name');
			$blueprint->tinyText('phone')->nullable(true);
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $blueprint) {
			$blueprint->renameColumn('first_name', 'name');
			$blueprint->dropColumn('last_name');
			$blueprint->dropColumn('phone');
		});
	}
	
}
