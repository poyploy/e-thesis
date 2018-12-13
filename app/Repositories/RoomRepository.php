<?php

namespace App\Repositories;

use App\Models\Room;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RoomRepository
 * @package App\Repositories
 * @version November 22, 2018, 1:16 pm UTC
 *
 * @method Room findWithoutFail($id, $columns = ['*'])
 * @method Room find($id, $columns = ['*'])
 * @method Room first($columns = ['*'])
*/
class RoomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'num',
        'max_student'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Room::class;
    }
}
