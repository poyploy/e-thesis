<?php

namespace App\Repositories;

use App\Models\FormAssessment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FormAssessmentRepository
 * @package App\Repositories
 * @version February 5, 2019, 2:04 pm UTC
 *
 * @method FormAssessment findWithoutFail($id, $columns = ['*'])
 * @method FormAssessment find($id, $columns = ['*'])
 * @method FormAssessment first($columns = ['*'])
*/
class FormAssessmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'max'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FormAssessment::class;
    }
}
