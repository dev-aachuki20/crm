<?php

namespace App\Http\Controllers\Lead;

use App\DataTables\Lead\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Campaign;
use App\Models\TagList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class LeadController extends Controller
{
    public function index(LeadDataTable $dataTable)
    {
        abort_if(Gate::denies('area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $areas = Area::all();
        $campaigns = Campaign::all();
        $tagList = TagList::get();
        $qualificationTagList = json_decode($tagList);
        // dd($qualificationTagList);
        return view('lead.index', compact('areas','campaigns','qualificationTagList'));

        // return $dataTable->render('lead.index');
    }
}
