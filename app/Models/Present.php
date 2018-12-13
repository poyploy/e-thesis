<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Present
 * @package App\Models
 * @version December 11, 2018, 1:50 pm UTC
 *
 * @property \App\Models\Sequence sequence
 * @property \App\Models\Room room
 * @property \App\Models\Thesi thesi
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection Assessment
 * @property \Illuminate\Database\Eloquent\Collection Check
 * @property \Illuminate\Database\Eloquent\Collection permissions
 * @property \Illuminate\Database\Eloquent\Collection thesis
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property string|\Carbon\Carbon date
 * @property integer sequence_id
 * @property integer user_id
 * @property integer room_id
 * @property integer thesis_id
 */
class Present extends Model
{
    use SoftDeletes;

    public $table = 'present';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'date',
        'sequence_id',
        'user_id',
        'room_id',
        'thesis_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sequence_id' => 'integer',
        'user_id' => 'integer',
        'room_id' => 'integer',
        'thesis_id' => 'integer'
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
    public function sequence()
    {
        return $this->belongsTo(\App\Models\Sequence::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function thesi()
    {
        return $this->belongsTo(\App\Models\Thesi::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
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
    public function checks()
    {
        return $this->hasMany(\App\Models\Check::class);
    }
}
