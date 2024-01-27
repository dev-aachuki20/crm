<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\DataTables\CampaignDataTable;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function index(CampaignDataTable $dataTable)
    {
        try {
            // $allCampaign = Campaign::all();
            /* return view('user.campaign'); */
            return $dataTable->render('user.campaign');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function create()
    {
        try {
            
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            // $campaignValidator = new CampaignValidator('add');

            // if (!$campaignValidator->with($input)->passes()) {
            //     return response()->json(['status'=>false,'error'=>$campaignValidator->getErrors()[0]]);
            // }

            $validator = Validator::make($input, [
                'campaign_name'    => 'required|string|max:255',
                'assigned_channel' => 'required',
                'created_by'       => 'required',
                'description'      => 'required',
            ]);
            
            if ($validator->fails()) {
                $errorMessage = $validator->errors()->first();
            
                return response()->json([
                    'status' => 'false',
                    'error'  => $errorMessage,
                ], 422);
            }            

            $store = new Campaign();
            $store->campaign_name     = $input['campaign_name'];
            // $store->assigned_channel  = /* $input['assigned_channel'] ?? */ '';
            $store->description       = $input['description'];
            $store->status            = '1';
            $store->created_by        = \Auth::user()->id;

            if($store->save()){
                return response()->json(['status'=>true,'message'=>trans('messages.compaign_successfully_created')]);
            }
                return response()->json(['status'=>false,'error'=>trans('messages.sorry_unable_to_update')]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());
        }
    }

    public function show(string $id)
    {
        try {
            
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    /* public function destroy($id)
    {
        try {
            
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    } */

    public function delete(CampaignDataTable $dataTable, $id)
    {
        try {
            \Log::info($dataTable->getTable().''.$id.'');
            /* $campaign = Campaign::findOrFail($id); */
            return $dataTable->render('user.campaign');       
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }
}
