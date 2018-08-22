<?php

namespace App\Traits;

/**
 * Model 會被 實例化一次
 */
trait DataTable
{
    public function dataTable(Object $model, Object $resquest)
    {
        try {
            // dd($resquest->all());
            $query = $this->DataTableFormat($resquest->all());
        
            // start
            $model   = new $model;
            $primary = $model->getKeyName();
            
            // select
            $rows = $model->select($primary);
            foreach ($query['selects'] as $select) {
                if ($select === $primary) {
                    continue;
                }
                $rows->addSelect($select);
            }

            // limit && offset
            $rows = $rows->skip($query['skip'])->take($query['take']);

            // oederby
            foreach ($query['orders'] as $order) {
                $rows = $rows->orderby($order[0], $order[1]);
            }
            
            // get rows
            $rows = $rows->get();
            
            // Amount
            $amount = $model::count();
            // end
          
            $draw = $query['draw'];
        } catch (\Exception $e) {
            //
            dd($e);
        }
        
        return [
          'draw'            => $draw,
          'data'            => $rows,
          'recordsFiltered' => $amount,
          'recordsTotal'    => count($rows),
        ];
    }
    
    public function DataTableFormat($resquest = [])
    {
        $draw = $resquest['draw'] ?? $resquest['_'];
        $skip = $resquest['start'] ?? 0;
        $take = $resquest['length'] ?? 0;
        
        // dd($resquest);
        $selects = [];
        if (! empty($resquest['columns'])) {
            foreach ($resquest['columns'] as $column) {
                $selects[] = $column['data'];
            }
        }
        
        $orders = [];
        if (! empty($resquest['order'])) {
            foreach ($resquest['order'] as $order) {
                $orders[] = [
                  $resquest['columns'][$order['column']]['data'],
                  $order['dir']
                ];
            }
        }
        
        return [
          'selects' => $selects,
          'draw'    => $draw,
          'orders'  => $orders,
          'skip'    => $skip,
          'take'    => $take
        ];
    }
}
