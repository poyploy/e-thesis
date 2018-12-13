<?php

namespace App\Repositories;

use App\Models\Sequence;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SequenceRepository
 * @package App\Repositories
 * @version December 11, 2018, 12:30 pm UTC
 *
 * @method Sequence findWithoutFail($id, $columns = ['*'])
 * @method Sequence find($id, $columns = ['*'])
 * @method Sequence first($columns = ['*'])
*/
class SequenceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'year',
        'date_time'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sequence::class;
    }
}
