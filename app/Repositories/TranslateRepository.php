<?php

namespace App\Repositories;

use App\Models\Translate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TranslateRepository
 * @package App\Repositories
 * @version November 5, 2018, 8:33 am UTC
 *
 * @method Translate findWithoutFail($id, $columns = ['*'])
 * @method Translate find($id, $columns = ['*'])
 * @method Translate first($columns = ['*'])
*/
class TranslateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'target_id',
        'target_type',
        'user_id',
        'content',
        'tags'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Translate::class;
    }
}
