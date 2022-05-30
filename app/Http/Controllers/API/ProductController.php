<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProductResquest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function ProductDetails(ProductResquest $request)
    {
        $product = Product::where('id',$request->product_id)->first();
        if ($product) {
            return response()->json([
              'success' => 1,
              'product' => ProductResource::make($product),
             ], 200);
          } else {
            return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
             ], 400);
          }
    }
}
