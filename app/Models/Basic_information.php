<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Basic_information
 * @package App\Models
 * @version January 4, 2019, 11:18 am UTC
 *
 * @property \App\Models\User user
 * @property \App\Models\UsersRole usersRole
 * @property \Illuminate\Database\Eloquent\Collection permissions
 * @property \Illuminate\Database\Eloquent\Collection roomUsers
 * @property \Illuminate\Database\Eloquent\Collection thesis
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property string thesis title (TH)
 * @property string thesis title (EN)
 * @property string name
 * @property string surname
 * @property string student_id
 * @property integer user_id
 * @property integer user_role_id
 */
class Basic_information extends Model
{
    use SoftDeletes;

    public $table = 'basic_information';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'thesistitle_TH',
        'thesistitle_EN',
        'user_id',
        'tel'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'thesistitle_TH' => 'string',
        'thesistitle_EN' => 'string',
        'student_id' => 'string',
        'user_id' => 'integer',
        'tel' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'tel' => 'digits:10'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usersRole()
    {
        return $this->belongsTo(\App\Models\UsersRole::class);
    }
}
