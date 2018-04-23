<?php

namespace App\Repositories\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class DataTableCriteria.
 *
 * @package namespace App\Repositories\Criteria;
 */
class DataTableCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
  
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $_ = $this->request->get('_', null);
        $draw = $this->request->get('draw', null);
        $columns = $this->request->get('columns', null);
        $orderby = $this->request->get('order', null);
        $skip = $this->request->get('start', 0);
        $take = $this->request->get('length', 10);
        $search = $this->request->get('search', null);
        // dd($draw, $columns, $orderby, $skip, $take, $search);
        
        if ($take) {
            $model = $model->limit($take);
        }

        if ($skip && $take) {
            $model = $model->skip($skip);
        }
        
        if ($orderby && $columns) {
            foreach ($orderby as $order) {
                if ($columns[$order['column']]) {
                    $model = $model->orderBy($columns[$order['column']]['data'], $order['dir']);
                }
            }
        }

        return $model;
    }
}
