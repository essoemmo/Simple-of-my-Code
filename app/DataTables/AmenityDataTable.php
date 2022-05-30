<?php

namespace App\DataTables;

use App\Models\Amenity;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AmenityDataTable extends DataTable
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

                if (Auth::guard('admin')->user()->hasPermission('amenities-update')){
                    $btn ='<button type="button" class="btn btn-icon btn-icon rounded-circle btn-dark edit" data-toggle="modal"
                    data-target="#modal-edit-amenity" data-amenityid="'.$query->id.'" data-title_ar="'.$query->title_ar.'" data-title_en="'.$query->title_en.'" data-amenity_image="'.$query->image.'"><i data-feather="edit"></i></button> &nbsp;';
                   }else{
                    $btn = '<button  type="button" class="btn btn-icon btn-icon rounded-circle btn-dark disabled"><i data-feather="edit"></i></button>';
                   }

                if (Auth::guard('admin')->user()->hasPermission('amenities-delete')){
                    $btn = $btn.
                    '<form class="delete"  action="' . route("amenities.destroy", $query->id) . '"  method="POST" id="delform"
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
            ->rawColumns(['action', 'active', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Amenity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Amenity $model)
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
                    ->setTableId('amenity-table')
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
            'title' => ['title' =>  __('admin.title'), 'data' => 'title'],
            'image' => ['title' =>  __('admin.image'), 'data' => 'image'],
            'active' => ['title' =>  __('admin.active'), 'data' => 'active'],
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
        return 'Amenity_' . date('YmdHis');
    }
}
