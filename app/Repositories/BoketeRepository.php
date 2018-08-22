<?php

namespace App\Repositories;

use App\Models\Bokete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BoketeRepository
 * @package App\Repositories
 * @version May 29, 2018, 6:48 am UTC
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
    
    public function getBoketesByGoogleIDisNull()
    {
        return $this->model->whereNull('google_translate_id');
    }
    
    public function hasManyTranslates()
    {
        $model = $this->model->addSelect('translates')
                              ->whereHas('translates', function ($query) {
                                  $query->where('target_type', 'bokete');
                              });

        return $model;
    }
}
