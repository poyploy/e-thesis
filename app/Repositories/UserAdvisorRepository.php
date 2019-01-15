<?php

namespace App\Repositories;

use App\Models\UserAdvisor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserAdvisorRepository
 * @package App\Repositories
 * @version January 15, 2019, 1:04 pm UTC
 *
 * @method UserAdvisor findWithoutFail($id, $columns = ['*'])
 * @method UserAdvisor find($id, $columns = ['*'])
 * @method UserAdvisor first($columns = ['*'])
*/
class UserAdvisorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'room_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserAdvisor::class;
    }
}
