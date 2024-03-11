<?php

namespace App\Http\Controllers\Lead;

use Illuminate\Support\Facades\Gate;
use App\DataTables\Lead\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\TagList;
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
}
