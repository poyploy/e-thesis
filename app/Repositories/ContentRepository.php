<?php

namespace App\Repositories;

use App\Models\Content;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContentRepository
 * @package App\Repositories
 * @version January 31, 2019, 1:29 pm UTC
 *
 * @method Content findWithoutFail($id, $columns = ['*'])
 * @method Content find($id, $columns = ['*'])
 * @method Content first($columns = ['*'])
*/
class ContentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'subject',
        'body',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Content::class;
    }
}
