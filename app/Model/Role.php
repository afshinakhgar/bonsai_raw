<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/3/17
 * Time: 2:37 PM
 */

namespace App\Model;

use Kernel\Abstracts\AbstractModel;

class Role extends AbstractModel
{
    protected $fillable = [];


    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(\App\Model\User::class );
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class);
    }

}


