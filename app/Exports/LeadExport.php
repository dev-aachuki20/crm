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
            'E' => 10,
            'F' => 7,
            'G' => 10,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 25,
            'N' => 10,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
            'T' => 20,
            'U' => 20,
            'V' => 20,
        ];
    }

    public function headings(): array
    {
        return [
            trans('cruds.lead.fields.registration_date'),
            trans('cruds.lead.fields.first_name'),
            trans('cruds.lead.fields.last_name'),
            trans('cruds.lead.fields.identification'),
            trans('cruds.lead.fields.birth_date'),
            trans('cruds.lead.fields.gender'),
            trans('cruds.lead.fields.civil_status'),
            trans('cruds.lead.fields.phone'),
            trans('cruds.lead.fields.cell_phone'),
            trans('cruds.lead.fields.email'),
            trans('cruds.lead.fields.province'),
            trans('cruds.lead.fields.city'),
            trans('cruds.lead.fields.address'),
            trans('cruds.lead.fields.sector'),
            trans('cruds.lead.fields.reference'),
            trans('cruds.lead.fields.employment_status'),
            trans('cruds.lead.fields.social_security'),
            trans('cruds.lead.fields.company_name'),
            trans('cruds.lead.fields.occupation'),
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
            ucwords($row->name),
            ucwords($row->last_name),
            $row->identification,
            convertDateTimeFormat($row->birthdate,'date'),
            ucfirst(trans('cruds.genders.'.config('constants.genders')[$row->gender])),
            ucfirst(trans('cruds.civil_status.'.config('constants.civil_status')[$row->civil_status])),
            $row->phone,
            $row->cellphone,
            $row->email,
            $row->province,
            $row->city,
            $row->address,
            $row->sector,
            $row->reference,
            ucfirst(trans('cruds.employment_status.'.config('constants.employment_status')[$row->employment_status])),
            ucfirst(trans('cruds.social_securities.'.config('constants.social_securities')[$row->social_security])),
            ucwords($row->company_name),
            ucwords($row->occupation),
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
