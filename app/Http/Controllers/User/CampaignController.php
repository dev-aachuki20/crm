<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CampaignRequest;
use App\Models\Campaign;
use App\Models\TagList;
use Illuminate\Http\Request;
use App\DataTables\CampaignDataTable;
use Illuminate\Validation\ValidationException;
use App\Models\Channel;

class CampaignController extends Controller
{
    public function index(CampaignDataTable $dataTable)
    {
        try {
            $allChannel = Channel::all();
            return $dataTable->render('user.campaign', compact('allChannel'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // public function create()
    // {
    //     try {
    //     } catch (\Exception $e) {
    //         \Log::info($e->getMessage());
    //     }
    // }

    public function store(CampaignRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $store = new Campaign();
            $store->campaign_name     = $validatedData['campaign_name'];
            $store->assigned_channel  = $validatedData['assigned_channel'] ?? '';
            $store->description       = $validatedData['description'];
            $store->status            = '1';
            $store->created_by        = \Auth::user()->id;

            $store->save();

            $tagList = $request->input('tagList');
            $tag = TagList::firstOrCreate([
                'tag_name' => $tagList,
                'campaign_id' => $store->id,
            ]);

            // $store->tagLists()->attach($tag);

            if ($store) {

                return response()->json(['status' => true, 'message' => trans('messages.compaign_successfully_created')]);
            }

            return response()->json(['status' => false, 'error' => trans('messages.sorry_unable_to_update')]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'errors' => [$e->getMessage()]], 500);
        }
    }

    // public function show($id)
    // {
    //     try {
    //     } catch (\Exception $e) {
    //         \Log::info($e->getMessage());
    //     }
    // }

    public function edit(Request $request)
    {
        try {
            $campaign = Campaign::with('tagLists')->where('id', $request->id)->first();
            return response()->json(['status' => true, 'message' => '', 'data' => $campaign], 200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function update(CampaignRequest $request)
    {
        try {
            $input = $request->all();
            $data = [
                'campaign_name'    => $input['campaign_name'],
                'assigned_channel' => $input['assigned_channel'],
                'created_by'       => $input['created_by'],
                'description'      => $input['description'],
            ];

            $update = Campaign::where('id', $input['campaign_id'])->update($data);
            if ($update) {
                $tagList = $request->input('tagList');
                $tag = TagList::where('campaign_id', $input['campaign_id'])->update([
                    'tag_name' => $tagList,
                ]);
                return response()->json(['status' => true, 'message' => trans('messages.campaign_successfully_update')]);
            }

            return response()->json(['status' => false, 'error' => trans('messages.sorry_unable_to_update')]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'errors' => [$e->getMessage()]], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $campaign = Campaign::find($request->id);
            if (!$campaign) {
                return response()->json(['status' => false, 'error' => trans('messages.unable_to_delete')]);
            }
            $campaign->delete();
            return response()->json(['status' => true, 'message' => trans('messages.campaign_successfully_delete')]);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
}
