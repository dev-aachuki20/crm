<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Lead;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from another database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{

            // Connect to the source database and retrieve data
            \App::setLocale('es');

                // Connect to the source database and retrieve data
                $sourceLeads = DB::connection('mysql2')->table('lead10')->where('sector','!=','')->where('campaign_id','=','')->where('reference','=','')->limit(1176)->get();
            

                foreach ($sourceLeads as $lead) {
            

                    $addressValue = null;

                    if($lead->address){
                        $addressValue = $lead->address;
                    }

                    if($lead->sector){
                        $addressValue .= ','.$lead->sector;
                    }

                  /*  if($lead->reference){
                        $addressValue .= ','.$lead->reference;

                        $employmentStatusArr = config('constants.employment_status');

                        if($lead->company_name){

                            $employmentStatusValue =  $lead->company_name ? ucfirst(strtolower(trim($lead->company_name))) : '';
                        }


                        $employment_status = $employmentStatusValue ? getKeyByValue('employment_status', $employmentStatusArr, $employmentStatusValue) : null;
    
                        $updateData = [
                            'address'           => trim($addressValue,'"'),
                            'sector'            => null,
                            'reference'         => null,
                            'employment_status' => $employment_status,
                            'social_security'   => null,
                            'company_name'      => $lead->area_id ? $lead->area_id : null,
                            'occupation'        => $lead->campaign_id ? $lead->campaign_id : null,
                            'area_id'           => Null,
                            'campaign_id'       => Null,
                        ];

                            
                        // dd($lead,$updateData);

                        Lead::where('identification',$lead->identification)->update($updateData);

                        $updateRecords = [
                            'address'           => trim($addressValue,'"'),
                            'sector'            => null,
                            'reference'         => null,
                            'employment_status' => $lead->social_security,
                            'social_security'   => null,
                            'company_name'      => $lead->occupation ? $lead->occupation : null,
                            'occupation'        => $lead->area_id ? $lead->area_id : null,
                            'area_id'           => null,
                            'campaign_id'       => null,
                        ];

                        DB::connection('mysql2')->table('lead9')->where('id',$lead->id)->update();
                    }else{
*/
                        $employmentStatusArr = config('constants.employment_status');
                        $employmentStatusValue =  $lead->social_security ? ucfirst(strtolower(trim($lead->social_security))) : '';
                        $employment_status = $employmentStatusValue ? getKeyByValue('employment_status', $employmentStatusArr, $employmentStatusValue) : null;
    
                        $updateData = [
                            'province'          => $lead->province ? $lead->province : null,
                            'city'              => $lead->city ? trim($lead->city) :  null,
                            'address'           => trim($addressValue,'"'),
                            'sector'            => null,
                            'reference'         => null,
                            'employment_status' => $employment_status,
                            'social_security'   => null,
                            'company_name'      => $lead->occupation ? $lead->occupation : null,
                            'occupation'        => $lead->area_id ? $lead->area_id : null,
                            'area_id'           => Null,
                            'campaign_id'       => Null,
                        ];

                            
                        // dd($lead,$updateData);

                        Lead::where('identification',$lead->identification)->update($updateData);

                        $updateRecords = [
                            'address'           => trim($addressValue,'"'),
                            'sector'            => null,
                            'reference'         => null,
                            'employment_status' => $lead->social_security,
                            'social_security'   => null,
                            'company_name'      => $lead->occupation ? $lead->occupation : null,
                            'occupation'        => $lead->area_id ? $lead->area_id : null,
                            'area_id'           => null,
                            'campaign_id'       => null,
                        ];

                        DB::connection('mysql2')->table('lead10')->where('sector','!=','')->where('id',$lead->id)->update($updateRecords);
                    //}
            
            
                }


            /*
          $offset = 0; 
 
            for($i=0; $i<100; $i++){

                // Connect to the source database and retrieve data
                $sourceLeads = DB::connection('mysql2')->table('lead10')->skip($offset)->limit(1000)->get();
            
                foreach ($sourceLeads as $lead) {
            
                    $birthDate = !empty($lead->birthdate) ? \Carbon\Carbon::parse($lead->birthdate)->format('Y-m-d') : null;
                
                    $civilStatusArr = config('constants.civil_status');
    
                    $civilStatusValue =  $lead->civil_status ? ucfirst(strtolower(trim($lead->civil_status))) : '';
                    $civil_status = $civilStatusValue ? getKeyByValue('civil_status', $civilStatusArr, $civilStatusValue) : null;
    
    
                    $employmentStatusArr = config('constants.employment_status');
                    $employmentStatusValue =  $lead->employment_status ? ucfirst(strtolower(trim($lead->employment_status))) : '';
                    $employment_status = $employmentStatusValue ? getKeyByValue('employment_status', $employmentStatusArr, $employmentStatusValue) : null;
            
                    $createData = [
                        'name'           => $lead->name ? $lead->name : null,
                        'last_name'      => $lead->last_name ? $lead->last_name : null,
                        'email'          => $lead->email ? $lead->email : null,
                        'phone'          => $lead->phone ? $lead->phone : null,
                        'cellphone'      => $lead->cellphone ? $lead->cellphone : null,
                        'identification' => $lead->identification ? $lead->identification : null,
                        'identification_type' => $lead->identification_type ? $lead->identification_type  : null,
                        'birthdate'           => $birthDate,
                        'gender'              => $lead->gender ? $lead->gender : null,
                        'civil_status'        => $civil_status,
                        'province'          => $lead->province ? $lead->province : null,
                        'city'              => $lead->city ? $lead->city :  null,
                        'address'           => $lead->address ? $lead->address : null,
                        'sector'            => $lead->sector ? $lead->sector : null,
                        'reference'         => $lead->reference ? $lead->reference :  null,
                        'employment_status' => $employment_status,
                        'social_security'   => null,
                        'company_name'      => $lead->company_name ? $lead->company_name : null,
                        'occupation'        => $lead->occupation ? $lead->occupation : null,
                        'area_id'           => Null,
                        'campaign_id'       => Null,
                    ];
            
                    Lead::create($createData);
            
                }

                $offset +=1000;
            }
            
        */

            $this->info('Data imported successfully!');

        }catch (\Exception $e) {
            // \Log::info($e->getMessage().' '.$e->getFile().' '.$e->getLine());

            dd($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            
            $this->info(trans('messages.error_message'));
        }
       

        return 0;
    }
}
