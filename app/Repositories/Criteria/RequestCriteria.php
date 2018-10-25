<?php

namespace App\Repositories\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Schema;

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
    public function apply($query, \Prettus\Repository\Contracts\RepositoryInterface $repository)
    {
        $queries   = $this->request->all();
        $model     = $query->getModel();
        $tableName = $model->table;

        if (isset($queries['sort'])) {
            $sorts = explode(',', $queries['sort']);
            foreach ($sorts as $sort) {
                $field = $sort;
                $order = 'asc';
                if (ord($sort) === 45) {
                    $field = ltrim($field, '-');
                    $order = 'desc';
                }
                // if (Schema::hasColumn($tableName, $field)) {
                //     $query = $query->orderBy($field, $order);
                // }
                if (in_array($field, $model->fillable)) {
                    $query = $query->orderBy($field, $order);
                }
            }
        }

        if (isset($queries['fields']) && is_array($queries['fields'])) {
            $fields = $queries['fields'];

            if (isset($fields[$tableName])) {
                $selects = explode(',', $fields[$tableName]);
                foreach ($selects as $select) {
                    // if (Schema::hasColumn($tableName, $select)) {
                    //     $query = $query->addSelect($select);
                    // }
                    if (in_array($select, $model->fillable)) {
                        $query = $query->addSelect($select);
                    }
                }
            }

            // TODO Include
            //
        }

        if (isset($queries['filter']) && is_array($queries['filter'])) {
            $filters = $queries['filter'];
            foreach ($filters as $field => $whereValue) {
                // scope
                $scopeFunName = studly_case($field);
                if (method_exists($model, 'scope'.$scopeFunName)) {
                    $query = $query->$scopeFunName($whereValue);
                    continue;
                }

                // AND Where
                // if (Schema::hasColumn($tableName, $field)) {
                //     $query = $query->where($field, $whereValue);
                // }
                if (in_array($field, $model->fillable)) {
                    $query = $query->where($field, $whereValue);
                }
            }
        }

        // dd($queries, $query->toSql());

        return $query;
    }
}
