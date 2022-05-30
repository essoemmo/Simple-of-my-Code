<?php

namespace App\Http\Controllers\Restaurant;

use App\DataTables\restaurantorderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(restaurantorderDataTable $orders)
    {
        return $orders->render('restaurant.orders.index');
    }
}
