<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class CompanyTest extends TestCase
{
	
	public function testCompanyManage()
	{
		$user = User::factory()->create();
		
		$response = $this
			->actingAs($user)
			->withSession(['banned' => false])
			->postJson('/company/save', [
				'name' => 'Company name'.time(),
				'email' => 'company@email.ltd',
				'web' => 'https://google.cz',
			]);
		
		$response
			->assertStatus(200)
			->assertJson(['status' => 'ok']);
	}
}
