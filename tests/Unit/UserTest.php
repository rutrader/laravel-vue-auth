<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class UserTest extends TestCase
{
	
	use RefreshDatabase;
	
	/**
	 *
	 * @return void
	 */
	public function testCreateUser()
	{
		$user = new User();
		$user->first_name = 'first_name_test';
		$user->last_name = 'last_name';
		$user->phone = '123456789';
		$user->email = 'email@email.ltd';
		
		$this->assertNotNull($user->first_name);
		$this->assertNotNull($user->last_name);
		$this->assertNotNull($user->phone);
		$this->assertNotNull($user->email);
	}
	
}
