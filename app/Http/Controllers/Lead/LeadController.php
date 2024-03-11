<?php

namespace App\Http\Controllers\Lead;

use App\DataTables\Lead\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\TagList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class LeadController extends Controller
{
    public function index(LeadDataTable $dataTable)
    {
        try {
            // abort_if(Gate::denies('lead_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $areas = Area::all();
            $campaigns = Campaign::all();
            $tagList = TagList::get();
            $qualificationTagList = json_decode($tagList);
            
            $lead = Lead::with(['createdBy', 'area', 'campaign'])->get();
            // return view('lead.index', compact('areas','campaigns','qualificationTagList'));
            return $dataTable->render('lead.index', compact('areas', 'campaigns', 'qualificationTagList'));
        } catch (\Exception $e) {
            \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());
        }
    }
}
