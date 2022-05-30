<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoupon;
use App\Http\Requests\Admin\UpdateCoupon;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('coupons',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(CouponDataTable $coupons)
    {
        return $coupons->render('admin.coupons.index');
    }

    public function store(StoreCoupon $request)
    {
        $coupon = Coupon::create($request->validated());
        return response()->json(['status' => 'success', 'data' => $coupon]);
    }

    public function update(UpdateCoupon $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->validated());
        return response()->json(['status' => 'success', 'data' => $coupon]);
    }

    public function destroy($id)
    {
        $coupon = Coupon::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
