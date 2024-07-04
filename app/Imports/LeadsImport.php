<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LeadsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        
        foreach ($rows as $row) {
           
            dd($row);
            
            // \App\Models\User::create([
            //     'id'    => $row['id'],
            //     'name'  => $row['name'],
            //     'email' => $row['email'],
            // ]);
        }
    }
}
