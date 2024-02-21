<?php

namespace App\Http\Controllers\Campaign;

use Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\CampaignRequest;
use App\Models\Campaign;
use App\Models\TagList;
use Illuminate\Http\Request;
use App\DataTables\Campaign\CampaignDataTable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Channel;
use Illuminate\Support\Facades\DB;


class CampaignController extends Controller
{
    public function index(CampaignDataTable $dataTable)
    {
        abort_if(Gate::denies('compaign_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $allChannel = Channel::all();
            return $dataTable->render('campaign.index', compact('allChannel'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function store(CampaignRequest $request)
    {
        abort_if(Gate::denies('compaign_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();

            $requestData = $request->all();
            $requestData['status'] = '1';

            // $store = new Campaign();

            // $store->campaign_name     = $validatedData['campaign_name'];
            // // $store->assigned_channel  = $validatedData['assigned_channel'] ?? '';
            // $store->assigned_channel = implode(',', $validatedData['assigned_channel'] ?? []);

            // $store->description       = $validatedData['description'];

            // $store->status            = '1';
            // $store->created_by        = \Auth::user()->id;

            // $store->save();
            $campaign = Campaign::create($requestData);

            $tagList = $request->input('tagList');
            $tag = TagList::firstOrCreate([
                'tag_name' => $tagList,
                // 'campaign_id' => $store->id,
                'campaign_id' => $campaign->id,
            ]);

            $campaign->channels()->sync($validatedData['assigned_channel']);
            DB::commit();

            if ($campaign) {
                return response()->json(['status' => true, 'message' => trans('messages.compaign_successfully_created')]);
            }

            return response()->json(['status' => false, 'error' => trans('messages.sorry_unable_to_update')]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());

            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        }
    }

    public function edit(Request $request)
    {
        abort_if(Gate::denies('compaign_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $campaign = Campaign::with('tagLists', 'channels')->where('id', $request->id)->first();
            $channels = $campaign->channels ? $campaign->channels->pluck('id') : null;
            \Log::info($campaign);
            return response()->json(['status' => true, 'data' => $campaign, 'channels' => $channels ?? null], 200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function update(CampaignRequest $request)
    {
        abort_if(Gate::denies('compaign_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::beginTransaction();
        try {
            $input = $request->all();
            // $validatedData = $request->validated();
            $campaignId = $request->input('campaign_id');
            $campaign = Campaign::find($campaignId);

            // $data = [
            //     'campaign_name'    => $input['campaign_name'],
            //     'assigned_channel' => implode(',', $input['assigned_channel']),
            //     'created_by'       => $input['created_by'],
            //     'description'      => $input['description'],
            // ];
            // $update = Campaign::where('id', $input['campaign_id'])->update($data);
            $update = $campaign->update($input);


            if ($update) {
                $tagList = $request->input('tagList');
                $tag = TagList::where('campaign_id', $input['campaign_id'])->update([
                    'tag_name' => $tagList,
                ]);

                $campaign->channels()->sync($input['assigned_channel']);
                
                DB::commit();
                return response()->json(['status' => true, 'message' => trans('messages.campaign_successfully_update')]);
            }

            return response()->json(['status' => false, 'message' => trans('messages.sorry_unable_to_update')]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            // return response()->json(['status' => 'error', 'errors' => [$e->getMessage()]], 500);
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        }
    }

    public function delete(Request $request)
    {
        abort_if(Gate::denies('compaign_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $campaign = Campaign::find($request->id);
            if (!$campaign) {
                return response()->json(['status' => false, 'message' => trans('messages.unable_to_delete')]);
            }

            $assignedUsersCount = $campaign->users()->count();
            if ($assignedUsersCount > 0) {
                return response()->json(['status' => false, 'message' => trans('messages.campaign_associated_with_user')]);
            }

            $campaign->delete();
            return response()->json(['status' => true, 'message' => trans('messages.campaign_successfully_delete')]);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        }
    }
}
