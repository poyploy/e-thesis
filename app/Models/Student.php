<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Student
 * @package App\Models
 * @version February 6, 2019, 7:47 am UTC
 *
 * @property \App\Models\Field field
 * @property \Illuminate\Database\Eloquent\Collection AdvisorsApprove
 * @property \Illuminate\Database\Eloquent\Collection AdvisorsApprove
 * @property \Illuminate\Database\Eloquent\Collection Assessment
 * @property \Illuminate\Database\Eloquent\Collection Assessment
 * @property \Illuminate\Database\Eloquent\Collection BasicInformation
 * @property \Illuminate\Database\Eloquent\Collection Check
 * @property \Illuminate\Database\Eloquent\Collection News
 * @property \Illuminate\Database\Eloquent\Collection permissions
 * @property \Illuminate\Database\Eloquent\Collection Present
 * @property \Illuminate\Database\Eloquent\Collection RoomAdvisor
 * @property \Illuminate\Database\Eloquent\Collection RoomUser
 * @property \Illuminate\Database\Eloquent\Collection thesis
 * @property \Illuminate\Database\Eloquent\Collection Uploadfile
 * @property \Illuminate\Database\Eloquent\Collection UserPresent
 * @property \Illuminate\Database\Eloquent\Collection UsersRole
 * @property string student_id
 * @property string name_TH
 * @property string surname_TH
 * @property string name_EN
 * @property string surname_EN
 * @property string year
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string remember_token
 * @property integer user_role_id
 * @property integer field_id
 */
class Student extends Model
{
    use SoftDeletes;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'id';

    public $fillable = [
        'student_id',
        'name_TH',
        'surname_TH',
        'name_EN',
        'surname_EN',
        'year',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'user_role_id',
        'field_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'student_id' => 'string',
        'name_TH' => 'string',
        'surname_TH' => 'string',
        'name_EN' => 'string',
        'surname_EN' => 'string',
        'year' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
        'user_role_id' => 'integer',
        'field_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function field()
    {
        return $this->belongsTo(\App\Models\Field::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function advisorsApproves()
    {
        return $this->hasMany(\App\Models\AdvisorsApprove::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function assessments()
    {
        return $this->hasMany(\App\Models\Assessment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function file()
    {
        return $this->hasMany(\App\Models\UploadFile::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function basicInformations()
    {
        return $this->belongsTo(\App\Models\Basic_information::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function checks()
    {
        return $this->hasMany(\App\Models\Check::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function news()
    {
        return $this->hasMany(\App\Models\News::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function presents()
    {
        return $this->hasMany(\App\Models\Present::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function roomAdvisors()
    {
        return $this->hasMany(\App\Models\RoomAdvisor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function roomUsers()
    {
        return $this->hasMany(\App\Models\RoomUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function uploadfiles()
    {
        return $this->hasMany(\App\Models\Uploadfile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function userPresents()
    {
        return $this->hasMany(\App\Models\UserPresent::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function usersRoles()
    {
        return $this->hasMany(\App\Models\UsersRole::class);
    }
}
