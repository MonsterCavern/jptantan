<?php

namespace App\Repositories;

use App\Models\Translate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TranslateRepository
 * @package App\Repositories
 * @version May 29, 2018, 7:29 am UTC
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
