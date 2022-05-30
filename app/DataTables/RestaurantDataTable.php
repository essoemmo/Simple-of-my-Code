<?php

namespace App\DataTables;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RestaurantDataTable extends DataTable
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

                if (Auth::guard('admin')->user()->hasPermission('restaurants-update')){
                    $btn ='<button type="button" class="btn btn-icon btn-icon rounded-circle btn-dark edit" data-toggle="modal"
                    data-target="#modal-edit-restaurant" data-restaurantid="'.$query->id.'" data-name="'.$query->name.'"
                    data-email="'.$query->email.'" data-phone="'.$query->phone.'" data-lat="'.$query->lat.'" data-address="'.$query->address.'" data-lang="'.$query->lang.'" data-restaurant_image="'.$query->image.'" data-restaurant_cover="'.$query->cover.'"><i data-feather="edit"></i></button> &nbsp;';
                   }else{
                    $btn = '<button  type="button" class="btn btn-icon btn-icon rounded-circle btn-dark disabled"><i data-feather="edit"></i></button>';
                   }

                if (Auth::guard('admin')->user()->hasPermission('restaurants-delete')){
                    $btn = $btn.
                    '<form class="delete"  action="' . route("restaurants.destroy", $query->id) . '"  method="POST" id="delform"
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
     * @param \App\Models\Restaurant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Restaurant $model)
    {
        return $model->query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('restaurant-table')
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
            'name' => ['title' =>  __('admin.name'), 'data' => 'name'],
            'email' => ['title' =>  __('admin.email'), 'data' => 'email'],
            'phone' => ['title' =>  __('admin.phone'), 'data' => 'phone'],
            'code' => ['title' =>  __('admin.code'), 'data' => 'code'],
            'active' => ['title' =>  __('admin.active'), 'data' => 'active'],
            'action' => ['title' =>  __('admin.action'), 'data' => 'action'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Restaurant_' . date('YmdHis');
    }
}
