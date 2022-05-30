<?php

namespace App\Http\Controllers\Restaurant;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreCategory;
use App\Http\Requests\Restaurant\UpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $categories)
    {
        return $categories->render('restaurant.categories.index');
    }

    public function store(StoreCategory $request)
    {
        $category = Category::create($request->validated());
        if ($category) {
            $category->update([ 'restaurant_id' => restId()]);
        }
        return response()->json(['status' => 'success', 'data' => $category]);
    }

    public function CategoryStatus(Request $request)
    {
        $category = Category::find($request->category_id)->update(['active' => $request->active]);
        return response()->json(['status' => 'success', 'data' => $category]);
    }

    public function update(UpdateCategory $request, $id)
    {
        $category = Category::find($id)->update($request->validated());
        return response()->json(['status' => 'success', 'data' => $category]);
    }

    public function destroy($id)
    {
        $category = Category::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
