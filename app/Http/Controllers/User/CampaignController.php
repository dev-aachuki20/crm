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
use Illuminate\Support\Facades\DB;


class CampaignController extends Controller
{
    public function index(CampaignDataTable $dataTable)
    {
        try {
            $allChannel = Channel::all();
            
            // $tmp = Campaign::find(39);
            // dd($tmp->users()->get()->count());

            return $dataTable->render('user.campaign', compact('allChannel'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function store(CampaignRequest $request)
    {
        DB::beginTransaction();
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

            DB::commit();

            if ($store) {

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
        try {
            $campaign = Campaign::with('tagLists')->where('id', $request->id)->first();
            return response()->json(['status' => true, 'data' => $campaign], 200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function update(CampaignRequest $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->all();
            $data = [
                'campaign_name'    => $input['campaign_name'],
                'assigned_channel' => $input['assigned_channel'],
                'created_by'       => $input['created_by'],
                'description'      => $input['description'],
            ];

            $update = Campaign::where('id', $input['campaign_id'])->update($data);
            DB::commit();

            if ($update) {
                $tagList = $request->input('tagList');
                $tag = TagList::where('campaign_id', $input['campaign_id'])->update([
                    'tag_name' => $tagList,
                ]);
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
        try {
            $campaign = Campaign::find($request->id);
            if (!$campaign) {
                return response()->json(['status' => false, 'message' => trans('messages.unable_to_delete')]);
            }

            $assignedUsersCount = $campaign->users()->count();
            if($assignedUsersCount > 0){
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
