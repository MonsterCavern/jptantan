<?php

namespace App\Repositories;

use Yajra\DataTables\Facades\Datatables;

/**
 *
 */
trait CommonRepository
{
    public function datatable()
    {
        $this->applyCriteria();
        $this->applyScope();
    
        $model = $this->model;
        // dd($model->toSql(), $model->getBindings());
        
        return Datatables::eloquent($model)->make(true);
    }
}
