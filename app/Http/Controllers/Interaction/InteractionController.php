<?php

namespace App\Http\Controllers\Interaction;

use Gate;
use App\Models\Interaction;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Interaction\InteractionDataTable;
use Symfony\Component\HttpFoundation\Response;

class InteractionController extends Controller
{
    public function index(InteractionDataTable $dataTable)
    {
        abort_if(Gate::denies('interaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $dataTable->render('interaction.index');
        
    }

    public function create($uuid){
       
        abort_if(Gate::denies('interaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead = Lead::where('uuid',$uuid)->first();

        $htmlView = view('interaction.create', compact('lead'))->render();
        return response()->json(['success' => true, 'htmlView' => $htmlView]);
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('interaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead = Lead::where('uuid',$request->lead_id)->first();

        if($lead){

            $exists_qualification = $lead ? json_decode($lead->campaign->tagLists->tag_name,true) :'';

            $request->validate([
                'registration_at' => 'required',
                'lead_id'        => 'required',
                'phone'          => 'required|numeric|regex:/^[0-9]{7,15}$/',
                'qualification'  => 'required|in:'.implode(',',$exists_qualification),
                'customer_observation' => 'required|string|',
            ],[
                'phone.regex'          => 'The :attribute must be between 7 and 15 digits.',
            ]);

            try{

                $insertRecord = [
                    'lead_id' => $lead->id,
                    'registration_at' => \carbon\carbon::parse($request->registration_at),
                    'phone'         => $request->phone,
                    'qualification' => $request->qualification,
                    'customer_observation' => $request->customer_observation,
                ];
    
                $lead->interactions()->create($insertRecord);

                return response()->json(['status' => true, 'message' => trans('messages.interaction.interaction_created')],200);
            
            
            }catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
            }

        }else{
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }
    }

    public function edit(Request $request)
    {
        abort_if(Gate::denies('interaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $interaction = Interaction::find($request->interaction);
            if($interaction){

                $lead = $interaction->lead;

                $htmlView = view('interaction.edit', compact('lead','interaction'))->render();
                return response()->json(['success' => true, 'htmlView' => $htmlView]);
            }else{
                return response()->json(['status' => true, 'message' => trans('messages.no_record_found')], 200);
            }

        } catch (\Exception $e) {
            \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }

    }

    public function update(Request $request)
    {
        abort_if(Gate::denies('interaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $interaction = Interaction::find($request->interaction);
        $exists_qualification = $interaction->lead ? json_decode($interaction->lead->campaign->tagLists->tag_name,true) :'';

        $request->validate([
            'phone'          => 'required|numeric|regex:/^[0-9]{7,15}$/',
            'qualification'  => 'required|in:'.implode(',',$exists_qualification),
            'customer_observation' => 'required|string|',
        ],
        [
            'phone.regex'          => 'The :attribute must be between 7 and 15 digits.',
        ]);

        try{
            if($request->ajax()){

                $input = [
                    'phone'         => $request->phone,
                    'qualification' => $request->qualification,
                    'customer_observation' => $request->customer_observation, 
                ];

                $lead = Interaction::findOrFail($request->interaction);
                $lead->update($input);
                return response()->json(['status' => true, 'message' => trans('messages.interaction.interaction_updated')],200);
            }
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }catch (\Exception $e) {
            \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }

    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('interaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $interaction = Interaction::find($request->interaction);

            if (!$interaction) {
                return response()->json(['status' => 'error', 'message' => trans('messages.interaction.interaction_not_found')]);
            }

            $interaction->delete();
            return response()->json([
                'message' => trans('messages.interaction.interaction_deleted'),
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());

            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')]);

        }
    }
}
