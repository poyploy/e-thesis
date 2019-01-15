<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 * @package App\Models
 * @version January 15, 2019, 12:15 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection basicInformation
 * @property \Illuminate\Database\Eloquent\Collection permissions
 * @property \Illuminate\Database\Eloquent\Collection roomUsers
 * @property \Illuminate\Database\Eloquent\Collection thesis
 * @property \Illuminate\Database\Eloquent\Collection uploadfile
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property string option
 * @property string value
 */
class Setting extends Model
{
    use SoftDeletes;

    public $table = 'setting';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'option',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'option' => 'string',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
