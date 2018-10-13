<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/3/17
 * Time: 2:37 PM
 */

namespace App\Model;

use Kernel\Abstracts\AbstractModel;

class Permission extends AbstractModel
{
    protected $fillable = [];


    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany(\App\Model\Role::class );
    }



}


