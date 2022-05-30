<?php

namespace App\DataTables;

use App\Models\SubSection;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubSectionDataTable extends DataTable
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
            ->addColumn('image', function ($query) {
                return '
                <div align="center">
                <img src=' . getImagePath($query->image) . ' border="0" style=" width: 90px; height: 90px;"/>
                </div>
                ';
            })
            ->addColumn('action', function ($row) {

                if (Auth::guard('admin')->user()->hasPermission('sections-update')){
                    $btn ='<button type="button" class="btn btn-icon btn-icon rounded-circle btn-dark edit" data-toggle="modal"
                    data-target="#modal-edit-subsection" data-subsectionid="'.$row->id.'" data-title_ar="'.$row->title_ar.'" data-title_en="'.$row->title_en.'" data-description_en="'.$row->description_en.'" data-description_ar="'.$row->description_ar.'" data-subsection_image="'.$row->image.'"><i data-feather="edit"></i></button> &nbsp;';
                   }else{
                    $btn = '<button  type="button" class="btn btn-icon btn-icon rounded-circle btn-dark disabled"><i data-feather="edit"></i></button>';
                   }

                if (Auth::guard('admin')->user()->hasPermission('sections-delete')){
                    $btn = $btn.
                    '<form class="delete"  action="' . route("subsections.destroy", $row->id) . '"  method="POST" id="delform"
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
            ->rawColumns(['action', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SubSection $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubSection $model)
    {
        return $model->query()->where('section_id', $this->id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('section-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->parameters([
                        "processing"   => true,
                        "serverSide"   => true,
                        "responsive"   => true,
                        "searching"    => true,
                        "drawCallback" => "function( settings ) {
                            feather.replace();
                        }"
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
            'id'          => ['title' => 'ID', 'data' => 'id'],
            'title'       => ['title' => __('admin.title'), 'data' => 'title'],
            'description' => ['title' =>__('admin.description'), 'data' => 'description','width' => '40%'],
            'image'       => ['title' =>__('admin.image'), 'data' => 'image'],
            'action'      => ['title' =>  __('admin.action'), 'data' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SubSection_' . date('YmdHis');
    }
}
