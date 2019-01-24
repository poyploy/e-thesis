<?php

namespace App\Repositories;

use App\Models\Assessment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AssessmentRepository
 * @package App\Repositories
 * @version January 24, 2019, 12:08 pm UTC
 *
 * @method Assessment findWithoutFail($id, $columns = ['*'])
 * @method Assessment find($id, $columns = ['*'])
 * @method Assessment first($columns = ['*'])
*/
class AssessmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'assessment_score1',
        'assessment_score2',
        'assessment_score3',
        'present_id',
        'room_id',
        'teacher_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Assessment::class;
    }
}
