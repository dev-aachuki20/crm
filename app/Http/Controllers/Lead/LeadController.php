<?php

namespace App\Http\Controllers\Lead;

use Illuminate\Support\Facades\Gate;
use App\DataTables\Lead\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreRequest;
use App\Http\Requests\Lead\UpdateRequest;
use App\Models\Campaign;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\LeadExport;
use Maatwebsite\Excel\Facades\Excel;


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

    public function delete(Request $request)
    {
        abort_if(Gate::denies('leads_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $lead = Lead::whereId($request->lead)->first();
            if($lead){
               
                $lead->delete();

                if($request->ajax()){
                    return response()->json(['status' => true, 'message' => trans('messages.lead.lead_deleted')]);
                }else{
                    return redirect()->route('home',['lang'=>app()->getLocale()])->with('success',trans('messages.lead.lead_deleted'));
                }
            }
    
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        } catch (\Exception $e) {
            \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => false, 'message' => trans('messages.error_message'),'error_detail'=>$e->getMessage().' '.$e->getFile().' '.$e->getLine()], 500);
        }
    }


    public function exportExcel(Request $request){

        if($request->ajax()){

            $searchValue = $request->input('search');
            $sortColumn = $request->input('sortColumn');
            $sortDirection = $request->input('sortDirection');

            return Excel::download(new LeadExport($searchValue, $sortColumn, $sortDirection), 'leads-list.xlsx');

        }

    }

}
