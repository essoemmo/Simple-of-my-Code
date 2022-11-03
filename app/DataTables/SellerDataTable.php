<?php

namespace App\DataTables;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SellerDataTable extends DataTable
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
        ->editColumn('reset_balance',function($query) {
            $btn ='<button type="button" id="reset" data-seller_id="'.$query->id.'" class="btn btn-icon btn-icon rounded-circle btn-danger"><i data-feather="dollar-sign"></i></button> &nbsp;';
            return $btn;
        }) 
        ->editColumn('active', function ($query) {
            if ($query->active) {
                $btn = '
                <div align="center">
                    <label class="switch">
                    <input data-id="' . $query->id . '" type="checkbox" id="check" checked>
                        <div class="slider round">
                            <span class="on">ON</span>
                            <span class="off">OFF</span>
                        </div>
                    </label>
                </div>';
            } else {
                $btn = '
                <div align="center">
                    <label class="switch">
                    <input data-id="' . $query->id . '" type="checkbox" id="check">
                        <div class="slider round">
                            <span class="on">ON</span>
                            <span class="off">OFF</span>
                        </div>
                    </label>
                </div>';
            }

            return $btn;
        })
        ->addColumn('action', function ($query) {

            if (Auth::guard('admin')->user()->hasPermission('users-read')) {
                $btn ='<a href="' . route("orderseller",$query->id) . '" type="button" class="btn btn-icon btn-icon rounded-circle btn-success"><i data-feather="shopping-bag"></i></a> &nbsp;';
            }

            return $btn;
        })
        ->rawColumns(['action', 'active','reset_balance']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Seller $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->query()->where('type_id',3)->orderByDesc('id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('seller-table')
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
            'id'         => ['title' => 'ID', 'data' => 'id'],
            'name'       => ['title' =>  __('admin.name'), 'data' => 'name'],
            'owner_name' => ['title' =>  __('admin.owner_name'), 'data' => 'manager_name'],
            'email'      => ['title' =>  __('admin.email'), 'data' => 'email'],
            'phone'      => ['title' =>  __('admin.phone'), 'data' => 'phone'],
            'code'       => ['title' =>  __('admin.code'), 'data' => 'code'],
            'active'     => ['title' =>  __('admin.active'), 'data' => 'active'],
            'balance'    => ['title' =>  __('admin.balance'), 'data' => 'balance'],
            'action'     => ['title' =>  __('admin.orders'), 'data' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }

}
