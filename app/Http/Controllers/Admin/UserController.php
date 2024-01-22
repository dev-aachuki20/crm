<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Validators\Admin\UserValidator;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    protected $UserService;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    public function profile(Request $request){
        try {
            $userInfo = $this->UserService->userInfo($request);
            return view("admin.profile.profile")->with(compact("userInfo"));
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
        }
    }
    
    public function updateProfile(Request $request){
        try {
            $update = '';
           
            if(isset($request->old_password) || isset($request->password)){
                $validator = Validator::make($request->all(),[
                    'old_password'       => 'required',
                    'password'           => 'required|string|min:8|max:12',
                    'confirm_password'   => 'required|string|min:8|max:12',
                ]);
    
                if($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
               
                $user = Auth::user();
                if (Hash::check($request->old_password, $user->password)) {
                    if($request->old_password == $request->confirm_password){
                        return back()->with('fail', trans('messages.password_must_change_from_old'))->withInput($request->all());
                    }else{
                        /* Here, Update Your Password */
                        $userData = User::where('id', $user->id)->update([
                            'password' => Hash::make($request->confirm_password)
                        ]);
                        
                        $update = $this->UserService->updateUserInfo($request);

                        if($update){
                            return redirect()->route('profile')->with('success', trans('messages.user_profile_update_with_password'));
                        }
                    }
                }else{
                    return back()->with('fail', trans('messages.user_password_doesnot_match'))->withInput($request->all());
                }
            }else{
                $update = $this->UserService->updateUserInfo($request);

                if($update){
                    return redirect(route('profile'))->with('success', trans('messages.user_profile_updated'));
                }
            }
            
            return back()->with('fail', 'Sorry, Unable to update!')->withInput($request->all()); 
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
        }
    }
}
