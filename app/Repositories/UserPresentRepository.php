<?php

namespace App\Repositories;

use App\Models\UserPresent;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPresentRepository
 * @package App\Repositories
 * @version January 21, 2019, 12:10 pm UTC
 *
 * @method UserPresent findWithoutFail($id, $columns = ['*'])
 * @method UserPresent find($id, $columns = ['*'])
 * @method UserPresent first($columns = ['*'])
*/
class UserPresentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'present_id',
        'user_id',
        'room_id',
        'no'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPresent::class;
    }
}
