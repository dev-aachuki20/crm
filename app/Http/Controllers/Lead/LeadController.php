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
use App\Exports\FilteredUsersExport;

use App\Imports\LeadsImport;

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
        //dd($request->all() , 'df');
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

            $length = $request->input('length');
            $searchValue = $request->input('search');
            $sortColumn = $request->input('sortColumn');
            $sortDirection = $request->input('sortDirection');

            return Excel::download(new LeadExport($length,$searchValue, $sortColumn, $sortDirection), 'leads-list.xlsx');
        }
    }


    public function showImportExcelForm(){
        return view('lead.import-lead');
    }

    public function importExcel(Request $request){

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        // Import the data
        // Excel::import(new LeadsImport, $request->file('file'));
        $collection = Excel::toCollection(new LeadsImport, $request->file('file'));

        dd($collection);

         // List of identification numbers to retrieve
         $ids_to_retrieve = [930297676,
         940527849,
         2000117735,
         1311586646,
         928041755,
         1713551800,
         1307705531,
         951494301,
         801936964,
         1313512491,
         1351697808,
         502005564,
         1705415543,
         917101966,
         1710294206,
         918626052,
         1708503667,
         1000900850,
         1717799629,
         928747575,
         401053442,
         1715786941,
         1001171261,
         1719923680,
         1714240031,
         923251037,
         1707815062,
         1202341218,
         1711159424,
         924646185,
         801715996,
         1712954849,
         1002857447,
         1713693271,
         502284334,
         1003278056,
         1716225634,
         1311606451,
         1002261061,
         1713919478,
         1715656946,
         1001582186,
         2100292800,
         1712568342,
         1721330817,
         103924270,
         401622691,
         1720641636,
         1702820786,
         1804834891,
         1711237808,
         1001731684,
         1716621774,
         1704622693,
         1719117143,
         1714859319,
         704124510,
         1206459974,
         1720428521,
         923717912,
         1003158035,
         101663375,
         1718135013,
         500985726,
         919253039,
         1719561753,
         703345637,
         1709251589,
         926872052,
         913039426,
         1722443353,
         1720229051,
         1722165964,
         905586822,
         914567755,
         1715579072,
         1712676954,
         1713635223,
         907420020,
         1721194015,
         1710749621,
         1718256181,
         1722801204,
         1714872593,
         603870411,
         602832958,
         907930366,
         927591107,
         1707418842,
         1001567732,
         1003230420,
         918370800,
         1712776341,
         1718758483,
         1103232540,
         920550555,
         1720086857,
         1002452363,
         1715607691,
         1706689286,
         1712368677,
         1712285327,
         401115092,
         1715275903,
         1710969690,
         1716112204,
         100725340,
         101365153,
         101487395,
         102147139,
         102346004,
         300340668,
         400368155,
         401428685,
         501174254,
         502033269,
         502683733,
         600818306,
         604069286,
         701650269,
         703040246,
         800129504,
         802776955,
         803095413,
         900796194,
         901013128,
         904143534,
         905076832,
         905482022,
         906244926,
         906604004,
         906701149,
         906921937,
         908904683,
         910343367,
         910429976,
         912668894,
         912925435,
         913448718,
         913711354,
         913800355,
         914154711,
         915268387,
         915357123,
         915793343,
         915971030,
         916218803,
         916282106,
         917339491,
         917651200,
         919587394,
         919698001,
         919766931,
         920727070,
         921001863,
         921356713,
         921522801,
         921626222,
         922591532,
         922723093,
         923928444,
         1000890143,
         1001722527,
         1002152872,
         1002853115,
         1002958351,
         1003117809,
         1003276985,
         1003950522,
         1205111121,
         1301032577,
         1302164437,
         1303317901,
         1303551772,
         1303982126,
         1304257668,
         1304581406,
         1304593062,
         1304685264,
         1305198895,
         1305578898,
         1305951152,
         1306055391,
         1306283118,
         1306711332,
         1307001337,
         1307156099,
         1307405025,
         1307553709,
         1307939650,
         1308089190];

         // Filter the collection
         $filtered = $collection->first()->filter(function ($row) use ($ids_to_retrieve) {
             return in_array($row['identification_number'], $ids_to_retrieve);
         });
 
         // Export the filtered data
         return Excel::download(new FilteredUsersExport($filtered), 'filtered_users.xlsx');

        // return back()->with('success', 'Data updated successfully.');
    }

}
