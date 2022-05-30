<?php

namespace App\Http\Controllers\Restaurant;

use App\DataTables\ProductDataTable;
use App\DataTables\TypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreProduct;
use App\Http\Requests\Restaurant\UpdateProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(ProductDataTable $products)
    {
        $categories = Category::where('restaurant_id',restId())->get();
        return $products->render('restaurant.products.index',compact('categories'));
    }

    public function allTypes(TypeDataTable $types, $id)
    {
        $product = Product::find($id);
        return $types->with('id', $id)->render('restaurant.products.types', compact('product'));
    }

    public function getTypes(Request $request)
    {
        $product = Product::find($request->product_id)->types()->get();
        return json_decode($product);
    }

    public function store(StoreProduct $request)
    {
        $product = Product::create($request->validated());
        if ($product) {
            $product->update([
                'restaurant_id' => restId(),
                'image' => UploadImage($request->image,'products')
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $product]);
    }

    public function ProductStatus(Request $request)
    {
        $product = Product::find($request->product_id)->update(['active' => $request->active]);
        return response()->json(['status' => 'success', 'data' => $product]);
    }

    public function update(UpdateProduct $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->validated());
        if ($request->image) {
            $product->update([
                'image' => UploadImage($request->image,'products')
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        unlink($product->image);
        $product->delete();
        return response()->json(['status' => 'success']);
    }
    
}
