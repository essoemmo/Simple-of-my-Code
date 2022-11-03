<?php

namespace App\DataTables;

use App\Models\Request;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RequestsDataTable extends DataTable
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
            ->editColumn('bank_account',function($query) {
                $btn ='<button type="button" class="btn btn-icon btn-icon rounded-circle btn-dark bank" data-toggle="modal" data-target="#bankList" 
                data-id="'.$query->id.'"><i data-feather="eye"></i></button> &nbsp;';
                return $btn;
            })
            ->rawColumns(['bank_account','reset_balance']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Request $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->query()->where('is_draw',1)->orderByDesc('id');;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('requests-table')
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
            'phone'      => ['title' =>  __('admin.phone'), 'data' => 'phone'],
            'balance'      => ['title' =>  __('admin.balance'), 'data' => 'balance'],
            'reset_balance' => ['title' =>  __('admin.reset_balance')],
            'bank_account' => ['title' =>  __('admin.bank_account'), 'data' => 'bank_account'],
        ];
    }

}
