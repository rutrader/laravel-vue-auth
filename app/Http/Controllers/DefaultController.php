<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class DefaultController extends Controller
{
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		return view('default');
	}
	
}
