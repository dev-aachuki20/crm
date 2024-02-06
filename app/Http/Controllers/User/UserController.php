<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\Campaign;
use App\Models\Role;
use App\Models\User;
use App\Notifications\PasswordSendOnMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        try {
            $roleData = Role::all();
            $campaigns = Campaign::all();
            return $dataTable->render('user.user', compact('roleData', 'campaigns'));
        } catch (\Throwable $th) {
            //throw $th;
        }
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

            $validatedData['name'] = $request->first_name.' '.$request->last_name;

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

            // Trigger the notification
            if ($request->send_password_on_email == 1) {
                $password = $request->password;
                $user->notify(new PasswordSendOnMail($password));
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

            return response()->json([
                'status' => 'success',
                'data' => $user,
                'role_id' => $roleId,
                'profile' => $user->ProfileImageUrl ?? null,
                'campaign_id' => explode(',', $user->campaign_id) ?? null,
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
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

            $validatedData['name'] = $request->first_name.' '.$request->last_name;
            
            $user->update($validatedData);
            if ($request->hasFile('image')) {
                if ($user->profileImage) {
                    $uploadImageId = $user->profileImage->id;
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'update', $uploadImageId);
                } else {
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'save', null);
                }
            }

            // Trigger the notification
            if ($request->send_password_on_email == 1 && !empty($request->password)) {
                $password = $request->password;
                $user->notify(new PasswordSendOnMail($password));
            }

            if (isset($validatedData['role'])) {
                $user->roles()->sync([$validatedData['role']]);
            }
            return response()->json([
                'message' => trans('messages.user.user_updated'),
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
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());

        }
    }
}
