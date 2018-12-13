<?php

namespace App\Repositories;

use App\Models\Menu;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MenuRepository
 * @package App\Repositories
 * @version December 9, 2018, 8:06 am UTC
 *
 * @method Menu findWithoutFail($id, $columns = ['*'])
 * @method Menu find($id, $columns = ['*'])
 * @method Menu first($columns = ['*'])
*/
class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'path',
        'route_name',
        'icon',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Menu::class;
    }
}
