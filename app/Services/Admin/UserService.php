<?php

namespace App\Services\Admin;

use App\Services\Service;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserService extends Service
{
    public function userInfo($request){
        try {            
            $user = Auth::user()->id;
            $userInfo = User::where('id', $user)->first();
            return $userInfo;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function updateUserInfo($request){
        try {
            $user = [
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'name'              => $request->name,
                'username'          => $request->username,
                'email'             => $request->email,
                'birthdate'         => $request->dateofbirth,
            ];

            $updateInfo = User::where('id', Auth::user()->id)->update($user);
            if($updateInfo){
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

}