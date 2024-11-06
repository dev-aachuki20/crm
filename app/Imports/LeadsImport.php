<?php

namespace App\Imports;

use App\Models\Lead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\App;

class LeadsImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        // return $rows;

        foreach ($rows as $row) {
            $registrationDate = !empty($row['registration_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', '1900-01-01')->addDays($row['registration_date'] - 2)->format('Y-m-d H:i:s') : null;

            $birthDate = !empty($row['birth_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', '1900-01-01')->addDays($row['birth_date'] - 2)->format('Y-m-d') : null;

            App::setLocale('en');
            $civilStatusArr = __('cruds.civil_status');
            $employmentStatusArr = __('cruds.employment_status');
            $identificationTypeArr = __('cruds.identification_type');

            App::setLocale('es');
            $civilStatusArrEs = __('cruds.civil_status');
            $employmentStatusArrEs = __('cruds.employment_status');
            $identificationTypeArrEs = __('cruds.identification_type');


            $civilStatusValue =  isset($row['civil_status']) ? ucfirst(strtolower(trim($row['civil_status']))) : '';
            $civil_status = $civilStatusValue ? getKeyByValue('civil_status', $civilStatusArr, $civilStatusArrEs, $civilStatusValue) : null;


            $employmentStatusValue =  isset($row['employment_status']) ? ucfirst(strtolower(trim($row['employment_status']))) : '';
            $employment_status = $employmentStatusValue ? getKeyByValue('employment_status', $employmentStatusArr, $employmentStatusArrEs, $employmentStatusValue) : null;


            $identificationTypeValue =  isset($row['identification']) ? ucfirst(strtolower(trim($row['identification']))) : '';
            $identification_type = $identificationTypeValue ? getKeyByValue('identification_type', $identificationTypeArr, $identificationTypeArrEs, $identificationTypeValue) : null;

            $gender = isset($row['gender']) ? ($row['gender'] === 'F' ? 2 : ($row['gender'] === 'M' ? 1 : null)) : null;


            $createData = [
                'name'                  => isset($row['first_name']) ? trim($row['first_name']) : null,
                'last_name'             => isset($row['last_name'])  ? trim($row['last_name']) : null,
                'email'                 => isset($row['email'])      ? trim($row['email']) : null,
                'phone'                 => isset($row['phone'])      ? trim($row['phone']) : null,
                'cellphone'             => isset($row['cellphone'])  ? trim($row['cellphone']) : null,
                'identification'        => isset($row['identification_number'])  ? trim($row['identification_number']) : null,
                'identification_type'   => $identification_type,
                'birthdate'             => $birthDate,
                'gender'                => $gender,
                'civil_status'          => $civil_status,
                'province'              => isset($row['province']) ? $row['province'] : null,
                'city'                  => isset($row['city']) ? $row['city'] :  null,
                'address'               => isset($row['street_address_intersection']) ?  $row['street_address_intersection'] : null,
                'sector'                => isset($row['sector']) ? $row['sector'] : null,
                'reference'             => isset($row['reference']) ?  $row['reference'] :  null,
                'employment_status'     => $employment_status,
                'social_security'       => null,
                'company_name'          => isset($row['company_name']) ?  $row['company_name'] : null,
                'occupation'            => isset($row['occupation']) ?  $row['occupation'] : null,
                'area_id'               => null,
                'campaign_id'           => null,
                'created_at'            => $registrationDate ?? null,
            ];

            Lead::create($createData);
        }
    }
}
