<?php

namespace App\Repositories;

use App\Models\Bokete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BoketeRepository
 * @package App\Repositories
 * @version October 25, 2018, 9:31 am UTC
 *
 * @method Bokete findWithoutFail($id, $columns = ['*'])
 * @method Bokete find($id, $columns = ['*'])
 * @method Bokete first($columns = ['*'])
*/
class BoketeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number',
        'url',
        'content',
        'ranting',
        'image',
        'source',
        'is_updated',
        'released_at',
        'google_translate_id',
        'baidu_translate_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Bokete::class;
    }
}
