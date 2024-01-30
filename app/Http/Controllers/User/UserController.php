<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Campaign;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
            $user = User::create($validatedData);
            if ($request->hasFile('image')) {
                if ($user->profileImage) {
                    $uploadImageId = $user->profileImage->id;
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'update', $uploadImageId);
                } else {
                    uploadImage($user, $request->image, 'profile/image/', "profile", 'original', 'save', null);
                }
            }
            $user->roles()->attach($validatedData['role']);

            return response()->json([
                'message' => toastr()->success(trans('messages.user.user_created')),
                'status' => 'success',
                'data' => $user
            ], 200);
        } catch (ValidationException $e) {
            // dd($e->getMessage());
            $errors = $e->errors();
            return response()->json([
                'status' => 'error',
                'errors' => $errors
            ], 422);
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

            $user->update($validatedData);

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
