<?php

namespace App\Repositories;

use App\Models\Admin;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdminRepository
 * @package App\Repositories
 * @version April 22, 2018, 4:17 am UTC
 *
 * @method Admin findWithoutFail($id, $columns = ['*'])
 * @method Admin find($id, $columns = ['*'])
 * @method Admin first($columns = ['*'])
*/
class AdminRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'account',
        'password',
        'type',
        'token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Admin::class;
    }
}