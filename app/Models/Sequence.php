<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sequence
 * @package App\Models
 * @version December 11, 2018, 12:30 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection permissions
 * @property \Illuminate\Database\Eloquent\Collection thesis
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property string year
 * @property string|\Carbon\Carbon date_time
 */
class Sequence extends Model
{
    use SoftDeletes;

    public $table = 'sequence';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'year',
        'date_time',
        'description',
        'uploadfile_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'uploadfile_status' => 'integer',
        'year' => 'string',
        'description'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'uploadfile_status' => 'required',
        'year' => 'required',
        'description'=>'required'
    ];

    
}
