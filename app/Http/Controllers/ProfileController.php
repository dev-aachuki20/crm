<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userDetail = Auth::user();
        $roles = $userDetail->roles->first();
        $allCampaign = Campaign::all();
        return view('auth.profile.index', compact('userDetail', 'roles', 'allCampaign'));
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        try {
            
            $inputs = $request->validated();            
            $user = Auth::User();
            
            if (!empty($inputs['campaign'])) {
                $inputs['campaign_id'] = implode(",", $inputs['campaign']);
            }
            $inputs['name'] = $request->first_name.' '.$request->last_name;
            
            $update = '';
            if($inputs['password_confirmation'] !== NULL && $inputs['password'] !== NULL && $inputs['password_confirmation'] === $inputs['password'] && $inputs['password'] !== ''){
                $inputs['password'] = Hash::make($inputs['password_confirmation']);
                $update = $user->update($inputs);
            }else{
                $update = $user->update([
                    'first_name'    => $inputs['first_name'],
                    'last_name'     => $inputs['last_name'],
                    'name'          => $inputs['name'],
                    'birthdate'     => $inputs['birthdate'],
                    'campaign_id'   => $inputs['campaign_id'],
                ]);
            }

            if ($request->image) {
                if ($user->profileImage) {
                    $uploadImageId = $user->profileImage->id;
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'update', $uploadImageId);
                } else {
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'save', null);
                }
            }


            if($update){
                return redirect()->back()->with('success', trans('messages.user_profile_updated'));
            }
            return redirect()->back()->with('error', trans('messages.sorry_unable_to_update'));
        }catch (\Exception $e) {
            \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return redirect()->back()->with('error', trans('messages.error_message'));

        }
    }
}
