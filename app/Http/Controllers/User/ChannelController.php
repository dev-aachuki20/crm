<?php

namespace App\Http\Controllers\User;

use App\DataTables\ChannelDataTable;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index(ChannelDataTable $dataTable)
    {
        return $dataTable->render('user.channel');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'channel_name' => 'required|max:255',
            'description' => 'required',
        ]);

        $channel = Channel::create($validatedData);
        return response()->json([
            'message' => toastr()->success(trans('messages.channel.channel_created')),
            'status' => 'success',
            'data' => $channel
        ]);
    }

    public function edit($channel_id, Request $request)
    {
        dd($channel_id);
        // $channelId = $request->input('channel_id');
        $channel = Channel::find($channel_id);

        return response()->json(['status' => 'success', 'data' => $channel]);
    }

    public function destroy(Request $request, $id)
    {
        dd($request->all());
    }
}
