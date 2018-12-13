<?php

namespace App\Repositories;

use App\Models\Present;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PresentRepository
 * @package App\Repositories
 * @version December 11, 2018, 1:50 pm UTC
 *
 * @method Present findWithoutFail($id, $columns = ['*'])
 * @method Present find($id, $columns = ['*'])
 * @method Present first($columns = ['*'])
*/
class PresentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date',
        'sequence_id',
        'user_id',
        'room_id',
        'thesis_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Present::class;
    }
}
