<?php
namespace App\Imports;

use App\Models\Lead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
       
        return $rows;
        
        // foreach ($rows as $row) 
        // {
        //     dd($row);

        //    /* $user = Lead::where('identification', $row[1])->first();

        //     if ($user) {
        //         $user->name = $row[0];
        //         $user->email = $row[1];
        //         $user->save();
        //     }*/
        // }
    }
}
