<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdvisorsApprove
 * @package App\Models
 * @version January 17, 2019, 12:33 pm UTC
 *
 * @property \App\Models\User user
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection basicInformation
 * @property \Illuminate\Database\Eloquent\Collection permissions
 * @property \Illuminate\Database\Eloquent\Collection roomAdvisors
 * @property \Illuminate\Database\Eloquent\Collection roomUsers
 * @property \Illuminate\Database\Eloquent\Collection thesis
 * @property \Illuminate\Database\Eloquent\Collection uploadfile
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property integer advisor_id
 * @property integer student_id
 * @property integer present_id
 * @property string remark
 */
class AdvisorsApprove extends Model
{
    use SoftDeletes;

    public $table = 'advisors_approve';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'advisor_id',
        'student_id',
        'present_id',
        'remark',
        'count',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'advisor_id' => 'integer',
        'student_id' => 'integer',
        'present_id' => 'integer',
        'remark' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'present_id' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function advisor()
    {
        return $this->belongsTo(\App\Models\User::class, 'advisor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function present()
    {
        return $this->belongsTo(\App\Models\Present::class);
    }
}
