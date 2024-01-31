<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\Campaign;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        $roleData = Role::all();
        $campaigns = Campaign::all();
        return $dataTable->render('user.user', compact('roleData', 'campaigns'));
    }

    public function store(UserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = bcrypt($request->password);

            if ($request->has('send_password_on_email') && $request->send_password_on_email == 1) {
                $validatedData['send_password_on_email'] = 1;
            } else {
                $validatedData['send_password_on_email'] = 0;
            }


            /* For Campaign Id */
            /* $campaignIds = $request->input('campaign_id');
            if ($campaignIds) {
                $campaignIds = explode(',', $campaignIds);
                $campaignIds = array_filter($campaignIds);
            } else {
                $campaignIds = [];
            }

            $validatedData['campaign_id'] = json_encode($campaignIds); */

            // upload profile
            $user = User::create($validatedData);
            if ($request->hasFile('image')) {
                if ($user->profileImage) {
                    $uploadImageId = $user->profileImage->id;
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'update', $uploadImageId);
                } else {
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'save', null);
                }
            }

            // Send mail
            if ($request->send_password_on_email == 1) {
                $fullname = $request->first_name . ' ' . $request->last_name;
                $password = $request->password;
                Mail::to($user->email)->send(new WelcomeMail($fullname, $password));
            }

            $user->roles()->attach($validatedData['role']);

            return response()->json(['message' => toastr()->success(trans('messages.user.user_created')), 'status' => 'success', 'data' => $user], 200);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    public function edit(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $user = User::find($userId);
            $roleId = $user->roles->first()->id ?? null;
            $image = $user->getProfileImage->file_path ?? '';
            return response()->json([
                'status' => 'success',
                'data' => $user,
                'role_id' => $roleId,
                'profile' => asset('storage/profile_images/' . $image) ?? null,
                'campaign_id' => explode(',', $user->campaign_id) ?? null,
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function update(UserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $userId = $request->input('user_id');
            $user = User::find($userId);

            if ($request->has('send_password_on_email')) {
                if ($request->send_password_on_email == 1) {
                    $validatedData['send_password_on_email'] = 1;
                } else {
                    $validatedData['send_password_on_email'] = 0;
                }
            } else {
                $validatedData['send_password_on_email'] = 0;
            }

            $user->update($validatedData);
            if ($request->hasFile('image')) {
                if ($user->profileImage) {
                    $uploadImageId = $user->profileImage->id;
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'update', $uploadImageId);
                } else {
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'save', null);
                }
            }

            // Send mail
            if ($request->send_password_on_email == 1 && !empty($request->password)) {
                $fullname = $request->first_name . ' ' . $request->last_name;
                $password = $request->password;
                Mail::to($user->email)->send(new WelcomeMail($fullname, $password));
            }

            if (isset($validatedData['role'])) {
                $user->roles()->sync([$validatedData['role']]);
            }
            return response()->json([
                'message' => toastr()->success(trans('messages.channel.channel_updated')),
                'status' => 'success'
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json([
                'status' => 'error',
                'errors' => $errors
            ], 422);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
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
