<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Lead;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($lang)
    {
        $currentLocale = app()->getLocale();
        return view('home');
    }

    public function updateLanguage(Request $request)
    {
        try {
            $language = $request->input('language') ?? 'en';
            app()->setLocale($language);
            $request->session()->put('userLanguage', $language);
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()]);
        }
    }

    public function checkCampaign(){
        $records = [];
        $alert_message = '';
        $campaignCount = Campaign::get()->count();
        if($campaignCount > 0){
            $records['exists'] = true; 
            $alert_message = trans('messages.retrieve_records_success');
        }else{
            $records['exists'] = false;
            $alert_message = trans('messages.compaign_no_records');
        }

        return response()->json(['status' => true,'message' =>$alert_message , 'data' => $records], 200);

    }

    public function submitSearchForm(Request $request){

        $request->validate([
            'search' => 'nullable|numeric|min:16|digits:16',
        ]);

        if(is_null($request->search)){
       
            $data['redirectRoute'] = route('home',['lang' => app()->getLocale()]);

            return response()->json(['status' => true,'message' =>trans('messages.retrieve_records_success'),'data'=>$data], 200);
        }

        $lead = Lead::where('identification',$request->search)->first();

        if($lead){
            $data['redirectRoute'] = route('search',['lang' => app()->getLocale(),'uuid' => $lead->uuid]);

            return response()->json(['status' => true,'message' =>trans('messages.retrieve_records_success'),'data'=>$data], 200);

        }else{
            $data['redirectRoute'] = route('home',['lang' => app()->getLocale()]);

            return response()->json(['status' => false,'message' =>trans('messages.interaction.interaction_not_found'),'data'=> $data], 200);
        }

    }

    public function searchInterations($lang,$uuid){
        $lead = Lead::where('uuid',$uuid)->first();
        if($lead){
            return view('search',compact('lead'));
        }else{
            return abort('404');
        }
    }
}
