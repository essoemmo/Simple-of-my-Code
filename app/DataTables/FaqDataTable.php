<?php

namespace App\DataTables;

use App\Models\Faq;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FaqDataTable extends DataTable
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

                if (Auth::guard('admin')->user()->hasPermission('faqs-update')){
                    $btn ='<button type="button" class="btn btn-icon btn-icon rounded-circle btn-dark edit" data-toggle="modal"
                    data-target="#modal-edit-faq" data-faqid="'.$row->id.'" data-question_ar="'.$row->question_ar.'" data-question_en="'.$row->question_en.'" data-answer_en="'.$row->answer_en.'" data-answer_ar="'.$row->answer_ar.'"><i data-feather="edit"></i></button> &nbsp;';
                   }else{
                    $btn = '<button  type="button" class="btn btn-icon btn-icon rounded-circle btn-dark disabled"><i data-feather="edit"></i></button>';
                   }

                if (Auth::guard('admin')->user()->hasPermission('faqs-delete')){
                    $btn = $btn.
                    '<form class="delete"  action="' . route("faqs.destroy", $row->id) . '"  method="POST" id="delform"
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
     * @param \App\Models\Faq $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Faq $model)
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
                    ->setTableId('faq-table')
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
            'question' => ['title' => __('admin.question'), 'data' => 'question'],
            'answer' => ['title' =>__('admin.answer'), 'data' => 'answer','width' => '50%'],
            'action' => ['title' =>  __('admin.action'), 'data' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }

}
