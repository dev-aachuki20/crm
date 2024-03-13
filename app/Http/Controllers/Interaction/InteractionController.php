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

        $request->validate([
            'registration_at' => 'required',
            'lead_id'        => 'required',
            'qualification'  => 'required',
            'customer_observation' => 'required|string|',
        ]);

        try{
            $lead = Lead::where('uuid',$request->lead_id)->first();

            if($lead){

                $insertRecord = [
                    'lead_id' => $lead->id,
                    'registration_at' => \carbon\carbon::parse($request->registration_at),
                    'qualification' => $request->qualification,
                    'customer_observation' => $request->customer_observation,
                ];
    
                $lead->interactions()->create($insertRecord);

                return response()->json(['status' => true, 'message' => trans('messages.interaction.interaction_created')],200);
            }else{
                return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
            }
           
        }catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => trans('messages.error_message')], 500);
        }
    }

    public function edit()
    {
        abort_if(Gate::denies('interaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    }

    public function update()
    {
        abort_if(Gate::denies('interaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('interaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $interaction = Interaction::find($request->id);

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

            return response()->json(['status' => 'error', 'message' => trans('messages.error_message'),'error_details'=>$e->getMessage() . ' '. $e->getLine()]);

        }
    }
}
