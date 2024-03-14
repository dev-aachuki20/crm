<?php

namespace App\Http\Controllers\Lead;

use Illuminate\Support\Facades\Gate;
use App\DataTables\Lead\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreRequest;
use App\Http\Requests\Lead\UpdateRequest;
use App\Models\Area;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\TagList;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Http\Response;


class LeadController extends Controller
{

    public function index(LeadDataTable $dataTable)
    {
        abort_if(Gate::denies('leads_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('lead.index');
    }

    public function create()
    {
        $campaigns = Campaign::orderBy('id','desc')->get();
        $htmlView = view('lead.create', compact('campaigns'))->render();
        return response()->json(['success' => true, 'htmlView' => $htmlView]);
    }

    public function store(StoreRequest $request)
    {
        try{
            $lead = Lead::create($request->all());
            return response()->json(['status' => true, 'message' => trans('messages.lead.lead_created')]);
        }catch (\Exception $e) {
            \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }
    }

    public function edit(Request $request)
    {
        try {
            $lead = Lead::findOrFail($request->lead);
            $campaigns = Campaign::orderBy('id','desc')->get();
            $htmlView = view('lead.edit', compact('campaigns','lead'))->render();
            return response()->json(['success' => true, 'htmlView' => $htmlView]);
        } catch (\Exception $e) {
            \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }
    }

    public function update(UpdateRequest $request)
    {
        try{
            if($request->ajax()){
                $input = $request->validated();
                $lead = Lead::findOrFail($request->lead);
                $lead->update($input);
                return response()->json(['status' => true, 'message' => trans('messages.lead.lead_updated')]);
            }
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }catch (\Exception $e) {
            \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }
    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('leads_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            if($request->ajax()){
                $lead = Lead::whereId($request->lead);
                $lead->delete();
                return response()->json(['status' => true, 'message' => trans('messages.lead.lead_updated')]);
            }
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        } catch (\Exception $e) {
            \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }
    }


    public function exportExcel(Request $request){

        dd('working...');
    }

}
