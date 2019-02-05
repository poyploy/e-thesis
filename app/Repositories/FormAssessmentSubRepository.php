<?php

namespace App\Repositories;

use App\Models\FormAssessmentSub;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FormAssessmentSubRepository
 * @package App\Repositories
 * @version February 5, 2019, 2:10 pm UTC
 *
 * @method FormAssessmentSub findWithoutFail($id, $columns = ['*'])
 * @method FormAssessmentSub find($id, $columns = ['*'])
 * @method FormAssessmentSub first($columns = ['*'])
*/
class FormAssessmentSubRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'form_id',
        'title',
        'max'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FormAssessmentSub::class;
    }
}
