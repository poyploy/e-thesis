<?php

namespace App\Repositories;

use App\Models\Basic_information;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Basic_informationRepository
 * @package App\Repositories
 * @version January 4, 2019, 11:18 am UTC
 *
 * @method Basic_information findWithoutFail($id, $columns = ['*'])
 * @method Basic_information find($id, $columns = ['*'])
 * @method Basic_information first($columns = ['*'])
*/
class Basic_informationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'thesistitle_TH',
        'thesistitle_EN',
        'name',
        'surname',
        'student_id',
        'user_id',
        'user_role_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Basic_information::class;
    }
}
