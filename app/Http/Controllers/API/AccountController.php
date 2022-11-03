<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountController extends BaseController
{
    use ResponseTrait;

    public function post(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'bankName'             => 'required|',
                'iban'                 => 'required|',
                'AccountHolder'        => 'required|',
                'AccountNumber'        => 'required|',
            ]);
            if ($validator->fails()) {
                return response(['success' => false, 'message' => $validator->errors()->first()], 422);
            }
            Account::create(['iban' => $request->iban, 'user_id' => auth()->user()->id, 'bankName' => $request->bankName, 'AccountHolder' => $request->AccountHolder, 'AccountNumber' => $request->AccountNumber]);
            DB::commit();
            return self::successResponse(__('application.added'));
        } catch (\Exception $e) {
            return $e;
            DB::rollback();
            // something went wrong
        }
    }
}
