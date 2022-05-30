<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('orders',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(OrderDataTable $orders)
    {
        return $orders->render('admin.orders.index');
    }

}
