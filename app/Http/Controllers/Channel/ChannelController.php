<?php

namespace App\Http\Controllers\Channel;

use Gate;
use App\DataTables\Channel\ChannelDataTable;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Channel\ChannelRequest;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    public function index(ChannelDataTable $dataTable)
    {
        abort_if(Gate::denies('channel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('channel.index');
    }

    public function store(ChannelRequest $request)
    {
        abort_if(Gate::denies('channel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(Gate::denies('channel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(Gate::denies('channel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(Gate::denies('channel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
