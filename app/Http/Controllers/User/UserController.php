<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Campaign;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        $roleData = Role::all();
        $campaigns = Campaign::all();

        return $dataTable->render('user.user', compact('roleData', 'campaigns'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'first_name'    => 'required|string|max:255',
                'last_name'     => 'required|string|max:255',
                'email'         => 'nullable|email|max:255',
                'birthdate'     => 'required|date_format:Y-m-d',
                'username'      => 'required|string|max:255',
                'password'      => 'required|string|min:8',
                'role'          => 'exists:roles,id',
                'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'campaign_id'    => 'required|array',
            ]);

            $validatedData['password'] = bcrypt($request->password);

            $user = User::create($validatedData);

            if ($request->image) {
                if ($user->profileImage) {
                    $uploadImageId = $user->profileImage->id;
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'update', $uploadImageId);
                } else {
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'save', null);
                }
            }

            $user->roles()->attach($validatedData['role']);
            // $user->campaigns()->attach($validatedData['campaign_id']);


            return response()->json([
                'message' => toastr()->success(trans('messages.user.user_created')),
                'status' => 'success',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $user = User::find($userId);
            return response()->json([
                'status' => 'success',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function update(Request $request)
    {
        dd('update');
        try {
            $validatedData = $request->validate([
                'channel_name' => 'required|max:255',
                'description' => 'required',
            ]);

            $channelId = $request->input('channel_id');
            $channel = Channel::find($channelId);

            $channel->update($validatedData);

            return response()->json([
                'message' => toastr()->success(trans('messages.channel.channel_updated')),
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = User::find($request->id);
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'user not found.']);
            }
            $user->delete();
            return response()->json([
                'message' => toastr()->success(trans('messages.user.user_deleted')),
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }
}
