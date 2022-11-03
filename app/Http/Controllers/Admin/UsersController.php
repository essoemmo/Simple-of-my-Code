<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\DataTables\OrganizationDataTable;
use App\DataTables\RequestsDataTable;
use App\DataTables\SellerDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUser;
use App\Http\Requests\Admin\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UsersController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('users',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(UserDataTable $users)
    {
        return $users->render('admin.users.index');
    }

    public function allkids(Request $request)
    {
        $kids = User::where('user_id',$request->user_id)->get();
         return json_decode($kids);
    }

    public function sellers(SellerDataTable $users)
    {
        return $users->render('admin.sellers.index');
    }

    public function sellerOrders(OrderDataTable $orders,$id)
    {
        $seller = User::find($id);
        return $orders->with('id', $id)->render('admin.sellers.orders', compact('seller'));
    }

    public function restBalance(Request $request)
    {
        $seller = User::find($request->seller_id);
        $seller->update(['balance' => 0]);
        return response()->json(['status' => 'success', 'data' => $seller]);
    }

    public function organizations(OrganizationDataTable $users)
    {
        return $users->render('admin.organizations.index');
    }

    public function UserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->active = $request->active;
        $user->save();
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    public function sellerRequest(RequestsDataTable $users)
    {
        return $users->render('admin.requests.index');
    }

    public function BankAccount(Request $request)
    {
        $seller = User::find($request->seller_id)->accounts()->get();
        return json_decode($seller);
    }

}
