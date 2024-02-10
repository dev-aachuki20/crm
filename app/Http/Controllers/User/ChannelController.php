<?php

namespace App\Http\Controllers\User;

use App\DataTables\ChannelDataTable;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\User\ChannelRequest;

class ChannelController extends Controller
{
    public function index(ChannelDataTable $dataTable)
    {
        return $dataTable->render('user.channel');
    }

    public function store(ChannelRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['status'] = 1;

            $channel = Channel::create($validatedData);
            return response()->json([
                'message' => trans('messages.channel.channel_created'),
                'status' => 'success',
                'data' => $channel
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {
            // \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
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
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    public function update(ChannelRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $channelId = $request->input('channel_id');
            $channel = Channel::find($channelId);

            $channel->update($validatedData);

            return response()->json([
                'message' => trans('messages.channel.channel_updated'),
                'status' => 'success'
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {

            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);

        }
    }

    public function destroy(Request $request)
    {
        try {
            $channel = Channel::find($request->id);
            if (!$channel) {
                return response()->json(['status' => 'error', 'message' => 'Channel not found.']);
            }
            $assignedCampaignCount = $channel->campaigns()->count();
            if($assignedCampaignCount > 0){
                return response()->json(['status' => 'error', 'message' => trans('messages.channel_associated_with_campian')]);
            }
            $channel->delete();
            return response()->json(['message' => trans('messages.channel.channel_deleted'), 'status' => 'success']);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        }
    }
}
