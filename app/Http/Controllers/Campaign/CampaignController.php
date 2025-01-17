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
use App\Models\Area;
use Illuminate\Support\Facades\DB;


class CampaignController extends Controller
{
    public function index(CampaignDataTable $dataTable)
    {
        abort_if(Gate::denies('compaign_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $allArea = Area::all();
            return $dataTable->render('campaign.index', compact('allArea'));
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
            $campaign = Campaign::create($requestData);

            $tagList = $request->input('tagList');

            $tagList = array_map('trim', json_decode($tagList,true));
            
            $tagListString  = '["'.implode('","',$tagList).'"]';

            $tag = TagList::create([
                'tag_name' => $tagListString,
                'campaign_id' => $campaign->id,
            ]);

            $campaign->areas()->sync($validatedData['assigned_area']);
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
            $campaign = Campaign::with('tagLists', 'areas')->where('id', $request->id)->first();
            $areas = $campaign->areas ? $campaign->areas->pluck('id') : null;
            \Log::info($campaign);
            return response()->json(['status' => true, 'data' => $campaign, 'areas' => $areas ?? null], 200);
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
            $update = $campaign->update($input);

            if ($update) {
                $tagList = $request->input('tagList');
                $tagList = array_map('trim', json_decode($tagList,true));
                $tagListString  = '["'.implode('","',$tagList).'"]';

                $tag = TagList::where('campaign_id', $input['campaign_id'])->update([
                    'tag_name' => $tagListString,
                ]);

                $campaign->areas()->sync($input['assigned_area']);

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

            if ($campaign->users()->count() > 0) {
                return response()->json(['status' => false, 'message' => trans('messages.campaign_associated_with_user')]);
            }

            if ($campaign->leads->count() > 0) {
                return response()->json(['status' => false, 'message' => trans('messages.campaign_associated_with_lead')]);
            }

            $campaign->delete();
            return response()->json(['status' => true, 'message' => trans('messages.campaign_successfully_delete')]);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        }
    }


    /* public function getAreas($lang,$campaignId)
    {
        $campaign = Campaign::findOrFail($campaignId);
        $areas = $campaign->areas()->pluck('area_name', 'areas.id');
        return response()->json(['status' => true, 'data' => $areas ?? null], 200);
    } */
    public function getAreaData(Request $request)
    {
        try {
            if($request->ajax()){
                $campaign = Campaign::findOrFail($request->campaignId);
                $areas = $campaign->areas()->pluck('area_name', 'areas.id');
                return response()->json(['status' => true, 'data' => $areas ?? null], 200);
            }
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        } catch (\Throwable $th) {
            \Log::info($th->getMessage().' '.$th->getFile().' '.$th->getLine());
        }
    }
}
