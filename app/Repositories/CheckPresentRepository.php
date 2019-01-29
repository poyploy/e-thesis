<?php

namespace App\Repositories;

use App\Models\CheckPresent;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CheckPresentRepository
 * @package App\Repositories
 * @version January 29, 2019, 12:22 pm UTC
 *
 * @method CheckPresent findWithoutFail($id, $columns = ['*'])
 * @method CheckPresent find($id, $columns = ['*'])
 * @method CheckPresent first($columns = ['*'])
*/
class CheckPresentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'check_status',
        'present_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CheckPresent::class;
    }
}
