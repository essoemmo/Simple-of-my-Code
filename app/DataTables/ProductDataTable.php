<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            ->editColumn('category_id', function ($query) {
                $category = $query->categories()->first();
                return $category->title;
            })
            ->editColumn('main_price', function ($query) {
               if ($query->main_price == NULL) {
                     return ' <button type="button" class="btn btn-icon btn-icon rounded-circle btn-dark types" data-id="' . $query->id . '" data-toggle="modal" data-target="#typesList">
                     <i data-feather="dollar-sign"></i>
                 </button>';
                } else {
                     return $query->main_price;
               }
            })
            ->addColumn('image', function ($query) {
                return '
                <div align="center">
                <img src=' . getImagePath($query->image) . ' style="width: 130px; height: 120px; border-radius: 60px;" class="img-circle"/>
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

                $btn ='<a href="' . route("protypes",$query->id) . '" type="button" class="btn btn-icon btn-icon rounded-circle btn-success"><i data-feather="grid"></i></a> &nbsp;';

                $btn = $btn.'<button type="button" class="btn btn-icon btn-icon rounded-circle btn-dark edit" data-toggle="modal"
                data-target="#modal-edit-product" data-productid="'.$query->id.'" data-catid="'.$query->categories->id.'" data-title_ar="'.$query->title_ar.'" data-title_en="'.$query->title_en.'" data-short_desc_ar="'.$query->short_desc_ar.'" data-short_desc_en="'.$query->short_desc_en.'" data-description_ar="'.$query->description_ar.'" data-description_en="'.$query->description_en.'" data-main_price="'.$query->main_price.'" data-product_image="'.$query->image.'"><i data-feather="edit"></i></button> &nbsp;';

                $btn = $btn.
                '<form class="delete"  action="' . route("products.destroy", $query->id) . '"  method="POST" id="delform"
                style="display: inline-block; right: 50px;" >
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger" title=" ' . 'Delete' . ' "><i data-feather="trash-2"></i></button>
                    </form>';

            return $btn;
        })
        ->rawColumns(['action', 'active', 'image', 'main_price']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
                    ->setTableId('product-table')
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
            'title' => ['title' =>  __('admin.title'), 'data' => 'title'],
            'category_id' => ['title' =>  __('admin.category'), 'data' => 'category_id'],
            'short_desc' => ['title' =>  __('admin.short_desc'), 'data' => 'short_desc'],
            'image' => ['title' =>  __('admin.image'), 'data' => 'image'],
            'main_price' => ['title' =>  __('admin.price'), 'data' => 'main_price'],
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
        return 'Product_' . date('YmdHis');
    }
}
