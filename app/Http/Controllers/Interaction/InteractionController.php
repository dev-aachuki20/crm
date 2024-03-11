<?php

namespace App\Http\Controllers\Interaction;

use Gate;
use App\Models\Interaction;
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

    public function store()
    {
        abort_if(Gate::denies('interaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
