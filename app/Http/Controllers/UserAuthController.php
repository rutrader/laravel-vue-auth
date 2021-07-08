<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class UserAuthController extends Controller
{
	
	public function login()
	{
		if(Auth::user()) {
			return response()->redirectToRoute('default');
		}
		
		return view('user.login');
	}
	
	public function loginCheck(Request $request)
	{
		$credentials = $request->validate([
			'email' => 'required|email',
			'password' => 'required'
		]);
		
		if(Auth::attempt($credentials)) {
			$request->session()->regenerate();
			
			return response()->json(['status' => 'ok']);
		}
		
		return response()->json($credentials, Response::HTTP_FORBIDDEN);
	}
	
	/**
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function logout(Request $request)
	{
		Auth::logout();
		
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		
		return redirect('/');
	}
	
}
