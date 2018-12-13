<?php

namespace App\Repositories;

use App\Models\RoomUser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RoomUserRepository
 * @package App\Repositories
 * @version December 11, 2018, 3:36 pm UTC
 *
 * @method RoomUser findWithoutFail($id, $columns = ['*'])
 * @method RoomUser find($id, $columns = ['*'])
 * @method RoomUser first($columns = ['*'])
*/
class RoomUserRepository extends BaseRepository
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
        return RoomUser::class;
    }
}
