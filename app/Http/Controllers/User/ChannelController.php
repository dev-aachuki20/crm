<?php

namespace App\Http\Controllers\User;

use App\DataTables\ChannelDataTable;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{
    public function index(ChannelDataTable $dataTable)
    {
        return $dataTable->render('user.channel');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'channel_name' => 'required|max:255',
                'description' => 'required',
            ]);
            // $validator = Validator::make($request->all(), [
            //     'channel_name' => 'required|max:255',
            //     'description' => 'required',
            // ]);

            // if (validator()->fails()) {
            //     return response()->json([
            //         'message' => toastr()->error(trans('messages.validation_failed')),
            //         'status' => 'error',
            //         'data' => null
            //     ], 422);
            // } else {
            $channel = Channel::create($validatedData);
            return response()->json([
                'message' => toastr()->success(trans('messages.channel.channel_created')),
                'status' => 'success',
                'data' => $channel
            ]);
            // }
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        try {
            $channelId = $request->input('channel_id');
            $channel = Channel::find($channelId);
            return response()->json([
                'status' => 'success',
                'data' => $channel
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function update(Request $request)
    {
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
            $channel = Channel::find($request->id);
            if (!$channel) {
                return response()->json(['status' => 'error', 'message' => 'Channel not found.']);
            }
            $channel->delete();
            return response()->json([
                'message' => toastr()->success(trans('messages.channel.channel_deleted')),
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }
}
