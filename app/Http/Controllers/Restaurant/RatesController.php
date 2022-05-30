<?php

namespace App\Http\Controllers\Restaurant;

use App\DataTables\restaurantrateDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function index(restaurantrateDataTable $rates)
    {
        return $rates->render('restaurant.rates.index');
    }
    
}
