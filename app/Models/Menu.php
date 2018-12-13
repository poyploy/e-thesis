<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menu
 * @package App\Models
 * @version December 9, 2018, 8:06 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Permission
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property string name
 * @property string path
 * @property string route_name
 * @property string icon
 * @property string description
 */
class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menus';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'path',
        'route_name',
        'icon',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'path' => 'string',
        'route_name' => 'string',
        'icon' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function permissions()
    {
        return $this->hasMany(\App\Models\Permission::class);
    }
}
