<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\restaurantorder;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class restaurantorderDataTable extends DataTable
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
            ->editColumn('order_status_id', function ($query) {
                $status = $query->status()->first();
                return $status->title;
            })
            ->editColumn('order_type_id', function ($query) {
                $type = $query->types()->first();
                return $type->title;
            })
            ->editColumn('created_at', function ($query) {
                $start = Carbon::parse($query->created_at)->format('Y-m-d');
                return $start;
            })
            ->addColumn('action', function ($query) {

                $btn ='<button type="button" class="btn btn-icon btn-icon rounded-circle btn-dark edit" data-toggle="modal"
                data-target="#modal-edit-category" data-categoryid="'.$query->id.'" data-title_ar="'.$query->title_ar.'" data-title_en="'.$query->title_en.'"><i data-feather="eye"></i></button> &nbsp;';

            return $btn;
        })
        ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\restaurantorder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
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
                    ->setTableId('restaurantorder-table')
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
            'order_status_id' => ['title' =>  __('admin.orderstatus'), 'data' => 'order_status_id'],
            'order_type_id' => ['title' =>  __('admin.ordertype'), 'data' => 'order_type_id'],
            'sub_total' => ['title' =>  __('admin.subtotal'), 'data' => 'sub_total'],
            'discount' => ['title' =>  __('admin.discount'), 'data' => 'discount'],
            'total' => ['title' =>  __('admin.total'), 'data' => 'total'],
            'created_at' => ['title' =>  __('admin.createdat'), 'data' => 'created_at'],
            'action' => ['title' =>  __('admin.action'), 'data' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'restaurantorder_' . date('YmdHis');
    }
}
