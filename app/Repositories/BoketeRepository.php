<?php

namespace App\Repositories;

use App\Models\Bokete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BoketeRepository
 * @package App\Repositories
 * @version May 28, 2018, 9:54 am UTC
 *
 * @method Bokete findWithoutFail($id, $columns = ['*'])
 * @method Bokete find($id, $columns = ['*'])
 * @method Bokete first($columns = ['*'])
*/
class BoketeRepository extends BaseRepository
{
    use CommonRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number',
        'url',
        'imgurl',
        'content',
        'ranting',
        'source'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Bokete::class;
    }
}
