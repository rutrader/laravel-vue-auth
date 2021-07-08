<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Ruslan Ishemgulov <ruslan.ishemgulov@gmail.com>
 */
class Company extends Model
{
	
	use HasFactory;
	
	protected $table = 'company';
	
	protected $fillable = [
		'name',
		'email',
		'logo_url',
		'web_url',
		'user_id'
	];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function users()
	{
		return $this->hasMany(User::class);
	}
	
}