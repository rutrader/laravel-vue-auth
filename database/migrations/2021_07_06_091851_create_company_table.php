<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class CreateCompanyTable extends Migration
{
	
	/**
	 * @return void
	 */
	public function up()
	{
		Schema::create('company', static function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->tinyText('name');
			$table->addColumn('text', 'email', ['length' => 320]);
			$table->tinyText('logo_url')->nullable(true);
			$table->tinyText('web_url')->nullable(true);
			
			$table
				->foreignId('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
		});
	}
	
	/**
	 * @return void
	 */
	public function down()
	{
		Schema::table('company', function (Blueprint $blueprint) {
			$blueprint->dropForeign(['user_id']);
		});
		
		Schema::dropIfExists('company');
	}
	
}
