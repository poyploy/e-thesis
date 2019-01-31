<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Content
 * @package App\Models
 * @version January 31, 2019, 1:29 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection basicInformation
 * @property \Illuminate\Database\Eloquent\Collection check
 * @property \Illuminate\Database\Eloquent\Collection permissions
 * @property \Illuminate\Database\Eloquent\Collection roomAdvisors
 * @property \Illuminate\Database\Eloquent\Collection roomUsers
 * @property \Illuminate\Database\Eloquent\Collection thesis
 * @property \Illuminate\Database\Eloquent\Collection uploadfile
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property string title
 * @property string subject
 * @property string body
 * @property boolean status
 */
class Content extends Model
{
    use SoftDeletes;

    public $table = 'content';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'title',
        'subject',
        'body',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'subject' => 'string',
        'body' => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
