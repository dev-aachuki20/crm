<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Uploads;
use App\Http\Requests\UpdateUserRequest;

use function PHPUnit\Framework\isNull;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userDetail = Auth::user();
        $roles = Role::all();
        return view('auth.profile.index', compact('userDetail', 'roles'));
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = Auth::User();
        $inputs = $request->all();
        if (isNull($request->password)) {
            $inputs = $request->except('password');
        }
        $user->update($inputs);
        $user->roles()->sync($request->input('roles', []));

        if ($request->image) {
            if ($user->profileImage) {
                $uploadImageId = $user->profileImage->id;
                uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'update', $uploadImageId);
            } else {
                uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'save', null);
            }
        }

        // return redirect()->back()->with('success', trans('messages.user_profile_updated'));
        toastr()->success(trans('messages.user_profile_updated'), trans('messages.success'));
        return redirect()->back();
    }
}
