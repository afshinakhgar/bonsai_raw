<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/12/17
 * Time: 5:16 PM
 */

namespace App\Model;


use Kernel\Abstracts\AbstractModel;

class Token extends AbstractModel
{

	public function user()
	{
		return $this->belongsTo(User::class);
	}


}
