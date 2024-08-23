<?php

namespace App\Http\Controllers\User;

use Gate;
use App\Http\Controllers\Controller;
use App\DataTables\User\UserDataTable;
use App\Http\Requests\User\UserRequest;
use App\Models\Campaign;
use App\Models\Role;
use App\Models\User;
use App\Notifications\PasswordSendOnMail;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            
            $roleData = Role::where('id','!=',1)->get();
            if(auth()->user()->is_administrator){
                //Not Super Admin and Adminstrator
                $roleData = Role::whereNotIN('id',[1,2])->get();

            }elseif(auth()->user()->is_supervior){

                //Not Super Admin and Adminstrator
                $roleData = Role::whereNotIN('id',[1,2,3])->get();

            }
            /*elseif(auth()->user()->is_vendor){

                //Not Super Admin , Adminstrator and supervior
                $roleData = Role::whereNotIN('id',[1,2,3,4])->get();

            }*/

            $campaigns = Campaign::all();
            return $dataTable->render('user.index', compact('roleData', 'campaigns'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function store(UserRequest $request)
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = bcrypt($request->password);

            if ($request->has('send_password_on_email') && $request->send_password_on_email == "on") {
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
            if ($request->has('send_password_on_email') && $request->send_password_on_email == "on") {
                $password = $request->password;
                $user->notify(new PasswordSendOnMail($password));
            }

            $user->NotificationSendToVerifyEmail();

            $user->roles()->sync([$validatedData['role']]);
            $user->campaigns()->sync($validatedData['campaign']);

            DB::commit(); 

            return response()->json(['message' => trans('messages.user.user_created'), 'status' => 'success', 'data' => $user], 200);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            // return response()->json(['status' => 'error', 'errors' => $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine()], 500);
            return response()->json(['status' => 'error', 'errors' => trans('messages.error_message')], 500);
        }
    }

    public function edit(Request $request)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $userId = $request->input('user_id');
            $user = User::find($userId);
            $roleId = $user->roles->first()->id ?? null;
            $campaigns = $user->campaigns ? $user->campaigns->pluck('id') : null;

            return response()->json([
                'status' => 'success',
                'data' => $user,
                'role_id' => $roleId,
                'profile' => $user->ProfileImageUrl ?? null,
                'campaigns' => $campaigns ?? null,
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'errors' => trans('messages.error_message')], 500);
        }
    }

    public function update(UserRequest $request)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $userId = $request->input('user_id');
            $user = User::find($userId);

            /* if ($request->has('send_password_on_email')) {
                if ($request->send_password_on_email == 1) {
                    $validatedData['send_password_on_email'] = 1;
                } else {
                    $validatedData['send_password_on_email'] = 0;
                }
            } else {
                $validatedData['send_password_on_email'] = 0;
            } */

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
            /* if ($request->send_password_on_email == 1 && !empty($request->password)) {
                $password = $request->password;
                $user->notify(new PasswordSendOnMail($password));
            } */

            if (isset($validatedData['role'])) {
                $user->roles()->sync([$validatedData['role']]);
            }
            $user->campaigns()->sync($validatedData['campaign']);
            DB::commit(); 
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
            DB::rollBack();
            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'errors' => trans('messages.error_message')], 500);
        }
    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $user = User::find($request->id);

            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'user not found.']);
            }

            if($user->profileImage){
                deleteFile($user->profileImage->id);
            }

            // $user->roles()->delete();
            $user->campaigns()->sync([]);
            $user->delete();
            return response()->json([
                'message' => trans('messages.user.user_deleted'),
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());

        }
    }
}
