<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Room
 * @package App\Models
 * @version November 22, 2018, 1:16 pm UTC
 *
 * @property string name
 * @property integer num
 * @property integer max_student
 */
class Room extends Model
{
    use SoftDeletes;

    public $table = 'room';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'num',
        'status',
        'max_student',
        'year'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'num' => 'integer',
        'status' => 'integer',
        'max_student' => 'integer'
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
    public function roomUsers()
    {
        return $this->hasMany(\App\Models\RoomUser::class);
    }
}
