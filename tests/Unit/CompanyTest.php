<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class CompanyTest extends TestCase
{
	
	use RefreshDatabase;
	
	/**
	 *
	 * @return void
	 */
	public function testCreateCompany()
	{
		$user = User::create([
			'first_name' => 'firstname_test',
			'last_name' => 'lastname_test',
			'email' => 'email@test.ltd',
			'password' => 'password'
		]);
		
		$company = Company::create([
			'name' => 'test_name',
			'email' => 'company@email.ltd',
			'logo_url' => 'logo/url/path',
			'web_url' => 'https://google.com/',
			'user_id' => $user->id
		]);
		
		$user->company = $company;
		
		$this->assertNotNull($user->company);
	}
	
}
