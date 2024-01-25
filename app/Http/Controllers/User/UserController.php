<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.user');
    }
    public function delete($id, UserDataTable $dataTable)
    {
        dd('sd');
        Auth::user()->delete();
        // dd($id);
        return $dataTable->render('user.user')->with('success', 'User deleted successfully');
    }
}
