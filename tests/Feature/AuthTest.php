<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
	
	use RefreshDatabase;
	
	/**
	 * @return void
	 */
	public function testRegistration()
	{
		$response = $this->postJson('/user/create', [
			'email' => 'test@email.ltd',
			'firstName' => 'Firstname',
			'lastName' => 'Lastname',
			'password' => 'password',
		]);
		
		$response->assertStatus(200);
		$this->assertGreaterThan(0, $response['user']);
	}
	
	public function testLogin()
	{
		$email = 'test'.mt_rand(1, 1000).'@email.ltd';
		
		User::factory()->create([
			'email' => $email,
			'first_name' => 'Firstname',
			'last_name' => 'Lastname',
			'password' => Hash::make('password'),
		]);
		
		$response = $this->postJson('/user/login-check', [
			'email' => $email,
			'password' => 'password',
		]);

		$response
			->assertStatus(200)
			->assertJson(['status' => 'ok']);
	}

}
