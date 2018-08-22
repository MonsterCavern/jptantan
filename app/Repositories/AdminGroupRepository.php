<?php

namespace App\Repositories;

use App\Models\AdminGroup;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdminGroupRepository
 * @package App\Repositories
 * @version April 30, 2018, 8:54 am UTC
 *
 * @method AdminGroup findWithoutFail($id, $columns = ['*'])
 * @method AdminGroup find($id, $columns = ['*'])
 * @method AdminGroup first($columns = ['*'])
 */
class AdminGroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AdminGroup::class;
    }
}
