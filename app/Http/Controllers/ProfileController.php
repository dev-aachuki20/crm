<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Language;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Uploads;
use App\Http\Requests\UpdateUserRequest;
use function PHPUnit\Framework\isNull;
use Illuminate\Validation\ValidationException;

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
            // $inputs = $request->all();
            if (isNull($request->password)) {
                $inputs = $request->except('password');
            }
            
            
            if (!empty($inputs['campaign'])) {
                $inputs['campaign_id'] = implode(",", $inputs['campaign']);
            }
            
            $user->update($inputs);

            if ($request->image) {
                if ($user->profileImage) {
                    $uploadImageId = $user->profileImage->id;
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'update', $uploadImageId);
                } else {
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'save', null);
                }
            }

            toastr()->success(trans('messages.user_profile_updated'), trans('messages.success'));
            return redirect()->back();
        }catch (\Exception $e) {
            \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());            
        }
    }
}
