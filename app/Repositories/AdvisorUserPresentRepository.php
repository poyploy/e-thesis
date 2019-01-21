<?php

namespace App\Repositories;

use App\Models\AdvisorUserPresent;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdvisorUserPresentRepository
 * @package App\Repositories
 * @version January 21, 2019, 1:16 pm UTC
 *
 * @method AdvisorUserPresent findWithoutFail($id, $columns = ['*'])
 * @method AdvisorUserPresent find($id, $columns = ['*'])
 * @method AdvisorUserPresent first($columns = ['*'])
*/
class AdvisorUserPresentRepository extends BaseRepository
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
        return AdvisorUserPresent::class;
    }
}
