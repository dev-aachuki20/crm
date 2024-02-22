<?php

namespace App\Http\Controllers\Area;

use Gate;
use App\DataTables\Area\AreaDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Area\AreaRequest;
use App\Models\Area;
use Symfony\Component\HttpFoundation\Response;

class AreaController extends Controller
{
    public function index(AreaDataTable $dataTable)
    {
        abort_if(Gate::denies('area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('area.index');
    }

    public function store(AreaRequest $request)
    {
        abort_if(Gate::denies('area_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $validatedData = $request->validated();
            $validatedData['status'] = 1;

            $area = Area::create($validatedData);
            return response()->json([
                'message' => trans('messages.area.area_created'),
                'status' => 'success',
                'data' => $area
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {
            // \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        }
    }

    public function edit(Request $request)
    {
        abort_if(Gate::denies('area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $areaId = $request->input('area_id');
            $area = Area::find($areaId);
            return response()->json([
                'status' => 'success',
                'data' => $area
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    public function update(AreaRequest $request)
    {
        abort_if(Gate::denies('area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $validatedData = $request->validated();

            $areaId = $request->input('area_id');
            $area = Area::find($areaId);

            $area->update($validatedData);

            return response()->json([
                'message' => trans('messages.area.area_updated'),
                'status' => 'success'
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        } catch (\Exception $e) {

            \Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        }
    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('area_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $area = Area::find($request->id);
            if (!$area) {
                return response()->json(['status' => 'error', 'message' => trans('messages.area_not_found')]);
            }
            $assignedCampaignCount = $area->campaigns()->count();
            if ($assignedCampaignCount > 0) {
                return response()->json(['status' => 'error', 'message' => trans('messages.area_associated_with_campian')]);
            }
            $area->delete();
            return response()->json(['message' => trans('messages.area.area_deleted'), 'status' => 'success']);
        } catch (\Exception $e) {
            // dd($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'message' => trans('messages.error_message')], 500);
        }
    }
}
