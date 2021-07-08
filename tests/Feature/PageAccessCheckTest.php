<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class PageAccessCheckTest extends TestCase
{
	
    public function testHomePageIsAccessible()
    {
        $response = $this->get('/');

        $response->assertStatus(Response::HTTP_OK);
    }
    
    public function testCompanyCreateIsNotAccessible()
    {
    	$response = $this->get('/company/manage');
    	
    	$response->assertStatus(Response::HTTP_FOUND);
    }
    
    public function testCompanySaveIsNotAccessible()
    {
    	$response = $this->get('/company/save');
    	
    	$response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);
    }
    
}
