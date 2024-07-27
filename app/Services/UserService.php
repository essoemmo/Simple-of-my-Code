<?php

namespace App\Services;

use App\Models\Users\User;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Users\UserDetail;


class UserService
{
    use ResponseTrait;

    public function createUser(array $userData, ?array $userDetails, ?array $attachments): ?User
    {
        DB::beginTransaction();
        try {
            $user = User::create($userData);
            if ($attachments) {
                $user->assignAttachment($attachments);
            }
            if ($userDetails) {
                $userDetails['user_id'] = $user->id;
                $data = UserDetail::create($userDetails);
           }
            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('User Service creation failed: '.$e->getMessage(), ['exception' => $e]);
            return null; // or throw an exception if you prefer
        }
    }

    public function updateUser(array $mainData, ?array $userDetails, ?array $attachments, $user): ?User
    {
        DB::beginTransaction();
        try {
            $user->update($mainData);

            if ($attachments) {
                $user->assignAttachment($attachments);
            }

            if ($userDetails) {
                $user->userDetail()->update($userDetails);
            }

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('User Service update failed: '.$e->getMessage(), ['exception' => $e]);
            return null; // or throw an exception if you prefer
        }
    }
}
