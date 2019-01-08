<?php

namespace App\Repositories;

use App\Models\UploadFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UploadFileRepository
 * @package App\Repositories
 * @version January 8, 2019, 1:39 pm UTC
 *
 * @method UploadFile findWithoutFail($id, $columns = ['*'])
 * @method UploadFile find($id, $columns = ['*'])
 * @method UploadFile first($columns = ['*'])
*/
class UploadFileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'sequence_id',
        'file',
        'student_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UploadFile::class;
    }
}
