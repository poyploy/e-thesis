<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 * @version December 9, 2018, 6:55 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection UsersRole
 * @property string name
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string remember_token
 */
class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $fillable = [
        'name_TH',
        'surname_TH',
        'name_EN',
        'surname_EN',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'updated_at',
        'student_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name_TH' => 'string',
        'surname_TH' => 'string',
        'name_EN' => 'string',
        'surname_EN' => 'string',
        // 'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
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
    public function usersRoles()
    {
        return $this->hasMany(\App\Models\UserRole::class);
    }
}
