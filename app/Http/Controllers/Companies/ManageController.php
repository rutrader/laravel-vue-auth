<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class ManageController extends Controller
{
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function manage()
	{
		if(!Auth::user()) {
			return response()->redirectToRoute('default');
		}
		
		/** @var \Illuminate\Database\Eloquent\Builder $company */
		$company = Company::where(['user_id' => Auth::id()]);
		
		return view('companies.manage')->with(['company' => $company->first()]);
	}
	
	/**
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 */
	public function save(Request $request)
	{
		if(!Auth::user()) {
			return response()->redirectToRoute('default');
		}
		
		$request->validate([
			'name' => 'required|string',
			'email' => 'required|email',
			'web' => 'url',
			'logo' => 'file|image|mimes:png,jpg,jpeg|max:2048',
		]);
		
		$company = Company::where(['user_id' => Auth::id()])
			->updateOrCreate([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'web_url' => $request->get('web'),
				'user_id' => Auth::id(),
			]);
		
		if ($request->file('logo')) {
			$fileName = $request->file('logo')->getClientOriginalName() . '_' . time();
			$filePath = $request->file('logo')->storeAs($company->id, $fileName, 'public');
			
			$company->logo_url = '/storage/' . $filePath;
		}
		$company->save();
		
		$message = !$company ? 'Something went wrong' : 'ok';
		
		return response()->json(['status' => $message]);
	}
	
}
