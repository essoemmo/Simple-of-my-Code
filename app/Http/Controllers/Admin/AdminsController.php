<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdmin;
use App\Http\Requests\Admin\UpdateAdmin;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('admins',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(AdminDataTable $admins)
    {
        $roles = Role::whereRoleNot(['super_admin'])->get();
        return $admins->render('admin.admins.index', compact('roles'));
    }

    public function store(StoreAdmin $request)
    {
        $admin =  Admin::create([
            'name'     => $request->name,
            'email'    => $request->email, 
            'password' => Hash::make($request->password)
        ]);
        $admin->attachRoles([$request->role_id]);
        return response()->json(['status' => 'success', 'data' => $admin]);
    }

    public function AdminStatus(Request $request)
    {
        $admin = Admin::find($request->admin_id);
        $admin->active = $request->active;
        $admin->save();

        return response()->json(['status' => 'success', 'data' => $admin]);
    }

    public function update(UpdateAdmin $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([
            'name'     => $request->name,
            'email'    => $request->email, 
            'password' => Hash::make($request->password)
        ]);
        $admin->syncRoles([$request->role_id]);
        return response()->json(['status' => 'success', 'data' => $admin]);
    }

    public function destroy($id)
    {
        $admin = Admin::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }

}
