<?php

namespace App\Http\Controllers\Admin;

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

    public function store(StoreUser $request)
    {
        $request->merge(['phone' => '+966'.$request->phone]);
        $user = User::create($request->all());
        if ($user) {
            $user->update([
                'image' => UploadImage($request->image,'users'),
                'code'  => mt_rand(1000, 9999),
                'password' => Hash::make($request->password)
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    public function UserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->active = $request->active;
        $user->save();
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    public function update(UpdateUser $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        if ($request->image) {
            $user->update([
                'image' => UploadImage($request->image,'users'),
                'password' => Hash::make($request->password)
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    public function destroy($id)
    {
        $user = User::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }

}
