<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permission
 * @package App\Models
 * @version December 9, 2018, 8:07 am UTC
 *
 * @property \App\Models\Menu menu
 * @property \App\Models\Role role
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property integer role_id
 * @property integer menu_id
 * @property integer can_access
 * @property integer can_visible
 * @property integer can_create
 * @property integer can_update
 * @property integer can_delete
 * @property integer can_show
 */
class Permission extends Model
{
    use SoftDeletes;

    public $table = 'permissions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'role_id',
        'menu_id',
        'can_access',
        'can_visible',
        'can_create',
        'can_update',
        'can_delete',
        'can_show'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role_id' => 'integer',
        'menu_id' => 'integer',
        'can_access' => 'integer',
        'can_visible' => 'integer',
        'can_create' => 'integer',
        'can_update' => 'integer',
        'can_delete' => 'integer',
        'can_show' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role_id' => 'required|integer|min:1',
        'menu_id' => 'required|integer|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function menu()
    {
        return $this->belongsTo(\App\Models\Menu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }
}
