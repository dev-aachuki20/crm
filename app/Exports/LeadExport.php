<?php

namespace App\Exports;

use App\Models\Lead;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class LeadExport implements FromQuery, WithHeadings,WithMapping, WithStyles, WithColumnWidths
{
    use Exportable;

    protected $searchValue, $sortColumnName, $sortDirection;

    public function __construct($searchValue,$sortColumnName,$sortDirection)
    {
        $this->searchValue = $searchValue;
        $this->sortColumnName = $sortColumnName;
        $this->sortDirection = $sortDirection;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
        ];
    }

    public function headings(): array
    {
        return [
            trans('cruds.lead.fields.registration_date'),
            trans('cruds.lead.fields.identification'),
            trans('cruds.lead.fields.phone'),
            trans('cruds.lead.fields.campaign'),
            trans('cruds.lead.fields.area'),
            trans('cruds.lead.fields.created_by'),
        ];

    }

    public function query()
    {
        $searchValue = $this->searchValue;
        
        $allLeads = Lead::query()->where(function ($query) use ($searchValue) {
            $query->where('phone', 'like', '%' . $searchValue . '%')
                ->orWhere('identification', 'like', '%' . $searchValue . '%')
                ->orWhereRelation('campaign', 'campaign_name', 'like', '%' . $searchValue . '%')
                ->orWhereRelation('area', 'area_name', 'like', '%' . $searchValue . '%')
                ->orWhereRelation('createdBy', 'name', 'like', '%' . $searchValue . '%')
                ->orWhereRaw("date_format(created_at, '" . config('constants.search_datetime_format') . "') like ?", ['%' . $searchValue . '%']);
        });

        $allLeads = $allLeads->orderBy($this->sortColumnName, $this->sortDirection);
     
        return $allLeads;
    }

    public function map($row): array
    {
        return [
            convertDateTimeFormat($row->created_at,'fulldatetime'),
            $row->identification,
            $row->phone,
            ucwords($row->campaign->campaign_name),
            ucwords($row->area->area_name),
            ucwords($row->createdBy->name),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply styles to the first row (headings) to make them bold
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
