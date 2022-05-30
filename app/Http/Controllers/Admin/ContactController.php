<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactUsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('contactus',$read = true, $create = false, $update = false, $delete = true);
    }

    public function index(ContactUsDataTable $contact)
    {
        return $contact->render('admin.contactus.index');
    }

    public function contactusDetails(Request $request)
    {
       $contact = ContactUs::where('id',$request->contact_id)->get();
       return json_decode($contact);
    }

    public function destroy($id)
    {
        $contact = ContactUs::whereId($id)->delete();
        return response()->json(['status'=>'success']);
    }


}
