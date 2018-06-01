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
        $model = QueryBuilder::for($model::query(), $this->request)->allowedFilters(['target_type','target_id']);
        if (isset($queries['equal'])) {
            foreach ($queries['equal'] as $key => $value) {
                $model = $model->where($key, $value);
            }
        }
        if (isset($queries['page'])) {
            $model = $model->skip($queries['page']);
        }
        
        
        return $model;
    }
}
