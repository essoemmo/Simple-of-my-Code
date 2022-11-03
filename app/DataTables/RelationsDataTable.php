<?php

namespace App\DataTables;

use App\Models\Relation;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RelationsDataTable extends DataTable
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
        ->addColumn('action', function ($row) {

            if (Auth::guard('admin')->user()->hasPermission('relations-update')){
                $btn ='<button type="button" class="btn btn-icon btn-icon rounded-circle btn-gradient-success edit" data-toggle="modal"
                data-target="#modal-edit-relation" data-relationid="'.$row->id.'" data-title_ar="'.$row->title_ar.'" data-title_en="'.$row->title_en.'"><i data-feather="edit"></i></button> &nbsp;';
               }else{
                $btn = '<button  type="button" class="btn btn-icon btn-icon rounded-circle btn-gradient-success disabled"><i data-feather="edit"></i></button>';
               }

            if (Auth::guard('admin')->user()->hasPermission('relations-delete')){
                $btn = $btn.
                '<form class="delete"  action="' . route("relations.destroy", $row->id) . '"  method="POST" id="delform"
                style="display: inline-block; right: 50px;" >
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger" title=" ' . 'Delete' . ' "><i data-feather="trash-2"></i></button>
                    </form>';
            }else{
                $btn = $btn. '<button class="btn btn-danger btn-xs disabled"><i data-feather="trash-2"></i></button>';
            }

            return $btn;
        })
        ->rawColumns(['action', 'active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Relation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Relation $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('relations-table')
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
                    "language" => '{"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"}',
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
            'title' => ['title' => __('admin.title'), 'data' => 'title'],
            'action' => ['title' =>  __('admin.action'), 'data' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }

}
