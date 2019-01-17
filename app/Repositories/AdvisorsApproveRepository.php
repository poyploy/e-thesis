<?php

namespace App\Repositories;

use App\Models\AdvisorsApprove;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdvisorsApproveRepository
 * @package App\Repositories
 * @version January 17, 2019, 12:33 pm UTC
 *
 * @method AdvisorsApprove findWithoutFail($id, $columns = ['*'])
 * @method AdvisorsApprove find($id, $columns = ['*'])
 * @method AdvisorsApprove first($columns = ['*'])
*/
class AdvisorsApproveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'advisor_id',
        'student_id',
        'present_id',
        'remark'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AdvisorsApprove::class;
    }
}
