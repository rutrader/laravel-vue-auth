<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class RegistrationController extends Controller
{
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function register()
	{
		if(Auth::user()) {
			return response()->redirectToRoute('default');
		}
		
		return view('user.registration');
    }
	
	/**
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function create(Request $request)
    {
    	$validatedData = $request->validate([
    		'email' => 'required|email|unique:users,email',
		    'firstName' => 'required|string',
		    'lastName' => 'required|string',
		    'password' => 'required',
	    ]);
    	
    	$userData = [
    		'email' => $request->email,
		    'first_name' => $request->firstName,
		    'last_name' => $request->lastName,
		    'phone' => $request->phone,
		    'password' => Hash::make($request->password),
	    ];
    	
    	$user = User::create($userData);
    	
    	if(!$user) {
    		return response()->json($validatedData);
	    }
    	
    	return response()->json(['user' => $user->id]);
    }
}
