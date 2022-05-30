<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RestaurantDetailsRequest;
use App\Http\Requests\User\RestaurantProductsRequest;
use App\Http\Resources\AmenityResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\RestaurantQrResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantsResource;
use App\Http\Resources\TypePlaceResource;
use App\Models\Amenity;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\TypePlace;
use Illuminate\Http\Request;
class RestaurantController extends Controller
{

    public function tables()
    {
      $type_place = TypePlace::get();

        if($type_place){
          return response()->json([ 
              'success'=> 1,
              'type_places'=> TypePlaceResource::collection($type_place),
          ],200);
        } else {
          return response()->json([
            'success' => 0,
            'message' => __('application.errorhere')
        ], 400);
        }
    }

    public function Search()
    {
      $restaurants = Restaurant::get();
      $products = Product::get();
      if($restaurants){
          return response()->json([ 
              'success'=> 1,
              'restaurants'=> RestaurantsResource::collection($restaurants),
              'products'=> ProductsResource::collection($products),
          ],200);
        } else {
          return response()->json([
            'success' => 0,
            'message' => __('application.errorhere')
        ], 400);
        }
    }

    public function Restaurants(Request $request)
    {
      $user = auth('api')->user();
      if ($user) {
        $restaurants = Restaurant::IsWithinMaxDistance($user->lang,$user->lat,100)->orderBy('distance' , 'ASC')->paginate(20)->where('distance' , '<' , 100);
      }else {
        $restaurants = Restaurant::paginate(20);
      }
        if ($restaurants) {
            return response()->json([
              'success' => 1,
              'restaurantus' => RestaurantsResource::collection($restaurants),
            ], 200);
          } else {
            return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
          ], 400);
          }
    }

    public function Restaurant(RestaurantDetailsRequest $request)
    {
      if ($request->restaurant_id) {
        $restaurant = $request->restaurant_id;
      }else{
        $restaurant = auth()->user('restaurant-api')->id;
      }
      $restaurant = Restaurant::where('id',$restaurant)->first();
      if ($restaurant) {
          return response()->json([
            'success' => 1,
            'restaurant' => RestaurantResource::make($restaurant),
          ], 200);
        } else {
          return response()->json([
            'success' => 0,
            'message' => __('application.errorhere')
          ], 400);
        }
    }

    public function RestaurantProducts(RestaurantProductsRequest $request)
    {
        $restaurant = Restaurant::where('id',$request->restaurant_id)->first();
        if ($restaurant) {
            return response()->json([
              'success' => 1,
              'restaurant_id' => $restaurant->id,
              'restaurant_name' => $restaurant->name,
              'restaurant_image' => getImagePath($restaurant->image),
              'categories' => CategoryResource::collection($restaurant->categories),
            ], 200);
          } else {
            return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
          ], 400);
          }
    }

    public function RestaurantQr(RestaurantDetailsRequest $request)
    {
      $restaurant = Restaurant::where('id',$request->restaurant_id)->first();
      if ($restaurant) {
          return response()->json(
             RestaurantQrResource::make($restaurant), 200);
        } else {
          return response()->json([
            'success' => 0,
            'message' => __('application.errorhere')
          ], 400);
        }
    }
    
}
