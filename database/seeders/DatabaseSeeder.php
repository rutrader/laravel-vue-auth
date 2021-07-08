<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class DatabaseSeeder extends Seeder
{

	public function run()
	{
		 User::factory()
			 ->count(10)
			 ->create();
	}
	
}
