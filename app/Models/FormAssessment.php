<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FormAssessment
 * @package App\Models
 * @version February 5, 2019, 2:29 pm UTC
 *
 * @property \App\Models\Sequence sequence
 * @property \Illuminate\Database\Eloquent\Collection basicInformation
 * @property \Illuminate\Database\Eloquent\Collection check
 * @property \Illuminate\Database\Eloquent\Collection FormAssessmentSub
 * @property \Illuminate\Database\Eloquent\Collection permissions
 * @property \Illuminate\Database\Eloquent\Collection roomAdvisors
 * @property \Illuminate\Database\Eloquent\Collection roomUsers
 * @property \Illuminate\Database\Eloquent\Collection thesis
 * @property \Illuminate\Database\Eloquent\Collection uploadfile
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property \Illuminate\Database\Eloquent\Collection usersRoles
 * @property string title
 * @property integer max
 * @property integer sequence_id
 */
class FormAssessment extends Model
{
    use SoftDeletes;

    public $table = 'form_assessment';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'title',
        'max',
        'sequence_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'max' => 'integer',
        'sequence_id' => 'integer'
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function formAssessmentSubs()
    {
        return $this->hasMany(\App\Models\FormAssessmentSub::class,'form_id');
    }
}
