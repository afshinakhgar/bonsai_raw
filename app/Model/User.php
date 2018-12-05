<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/9/18
 * Time: 10:33 AM
 */

namespace App\Model;


use Kernel\Abstracts\AbstractModel;

/**
 * Class User
 * @package App\Model
 */
class User extends AbstractModel
{
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];



	/**
	 * User tokens relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tokens()
	{
		return $this->hasMany(Token::class);
	}


	/**
	 * User Roles relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function roles()
	{
		return $this->belongsToMany('App\Model\Role');
	}
	/**
	 * User Roles relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */


}
