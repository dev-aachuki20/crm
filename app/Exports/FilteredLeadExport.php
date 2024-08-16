<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class FilteredLeadExport implements FromCollection
{
    protected $filtered;

    public function __construct(Collection $filtered)
    {
        $this->filtered = $filtered;
    }

    public function collection()
    {
        return $this->filtered;
    }
}
