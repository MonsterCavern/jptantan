<?php

namespace App\Repositories\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * [RequestCriteria description]
 */
class RequestCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * [__construct description]
     * @param Request $request [description]
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository.
     *
     * @param [type] $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, \Prettus\Repository\Contracts\RepositoryInterface $repository)
    {
        $queries = $this->request->all();
        
        // dd($model);
        $model = QueryBuilder::for($model::query(), $this->request)
              ->allowedIncludes($model->include)
              ->allowedFilters($model->fillable)
              ->allowedSorts($model->fillable);
              
        if (isset($queries['limit'])) {
            $model = $model->limit($queries['limit']);
            config(['repository.pagination.limit' => (int)$queries['limit']]);
        }
        
        if (isset($queries['page'])) {
            $model = $model->skip($queries['page']);
        }
        
        // if (isset($queries['equal'])) {
        //     foreach ($queries['equal'] as $key => $value) {
        //         $model = $model->where($key, $value);
        //     }
        // }
        
        // if (isset($queries['myself']) && $queries['myself'] == true) {
        //     $user  = $this->request->get('_user');
        //     $model = $model->where('user_id', $user->id);
        // }
        
        return $model;
    }
}
