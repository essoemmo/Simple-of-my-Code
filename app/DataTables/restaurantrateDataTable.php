<?php

namespace App\DataTables;

use App\Models\Rate;
use App\Models\restaurantrate;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class restaurantrateDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_id', function ($query) {
                $user = $query->users()->first();
                return $user->name;
            })
            // ->addColumn('action', function ($row) {

            //         $btn = 
            //         '<form class="delete"  action="' . route("rates.destroy", $row->id) . '"  method="POST" id="delform"
            //         style="display: inline-block; right: 50px;" >
            //         <input name="_method" type="hidden" value="DELETE">
            //         <input type="hidden" name="_token" value="' . csrf_token() . '">
            //         <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger" title=" ' . 'Delete' . ' "><i data-feather="trash-2"></i></button>
            //             </form>';

            //     return $btn;
            // })
            ->rawColumns(['action', 'active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\restaurantrate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Rate $model)
    {
        return $model->query()->where('restaurant_id', restId());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('restaurantrate-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->parameters([
                        "processing" => true,
                        "serverSide" => true,
                        "responsive" => true,
                        "searching"=> true,
                        "drawCallback" => "function( settings ) {
                            feather.replace();
                        }",
                    ])
                    ->orderBy(0);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['title' => 'ID', 'data' => 'id'],
            'user_id' => ['title' =>  __('admin.username'), 'data' => 'user_id'],
            'stars' => ['title' =>  __('admin.stars'), 'data' => 'stars'],
            'review' => ['title' =>  __('admin.review'), 'data' => 'review'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'restaurantrate_' . date('YmdHis');
    }
}
