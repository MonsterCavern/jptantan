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
        $columns = $this->request->get('columns', null);
        $table   = $model->getTable();
        if ($columns) {
            foreach ($columns as $column) {
                $model = $model->addSelect($table.'.'.$column['data']);
            }
        }

        return $model;
    }
}
