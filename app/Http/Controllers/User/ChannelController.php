<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index(){
        $allChannel = Channel::all();
        return view('user.channel', compact('allChannel'));
    }
}
