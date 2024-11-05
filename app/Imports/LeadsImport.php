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
            $registrationDate = \Carbon\Carbon::createFromFormat('Y-m-d', '1900-01-01')->addDays($row['registration_date'] - 2)->format('Y-m-d H:i:s');

            $birthDate = !empty($row['birth_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', '1900-01-01')->addDays($row['birth_date'] - 2)->format('Y-m-d') : null;

            App::setLocale('en');
            $civilStatusArr = __('cruds.civil_status');
            $employmentStatusArr = __('cruds.employment_status');
            $identificationTypeArr = __('cruds.identification_type');

            App::setLocale('es');
            $civilStatusArrEs = __('cruds.civil_status');
            $employmentStatusArrEs = __('cruds.employment_status');
            $identificationTypeArrEs = __('cruds.identification_type');


            $civilStatusValue =  $row['civil_status'] ? ucfirst(strtolower(trim($row['civil_status']))) : '';
            $civil_status = $civilStatusValue ? getKeyByValue('civil_status', $civilStatusArr, $civilStatusArrEs, $civilStatusValue) : null;


            $employmentStatusValue =  $row['employment_status'] ? ucfirst(strtolower(trim($row['employment_status']))) : '';
            $employment_status = $employmentStatusValue ? getKeyByValue('employment_status', $employmentStatusArr, $employmentStatusArrEs, $employmentStatusValue) : null;


            $identificationTypeValue =  $row['identification'] ? ucfirst(strtolower(trim($row['identification']))) : '';
            $identification_type = $identificationTypeValue ? getKeyByValue('identification_type', $identificationTypeArr, $identificationTypeArrEs, $identificationTypeValue) : null;

            $gender = isset($row['gender']) ? ($row['gender'] === 'F' ? 1 : ($row['gender'] === 'M' ? 2 : null)) : null;


            $createData = [
                'name'                  => $row['first_name'] ? trim($row['first_name']) : null,
                'last_name'             => $row['last_name']  ? trim($row['last_name']) : null,
                'email'                 => $row['email']      ? trim($row['email']) : null,
                'phone'                 => $row['phone']      ? trim($row['phone']) : null,
                'cellphone'             => $row['cellphone']  ? trim($row['cellphone']) : null,
                'identification'        => $row['identification_number']  ? trim($row['identification_number']) : null,
                'identification_type'   => $identification_type,   //getIdentificationType($row['identification']),
                'birthdate'             => $birthDate,
                'gender'                => $gender,
                'civil_status'          => $civil_status,
                'province'              => $row['province'] ? $row['province'] : null,
                'city'                  => $row['city'] ? $row['city'] :  null,
                'address'               => $row['street_address_intersection'] ?  $row['street_address_intersection'] : null,
                'sector'                => $row['sector'] ? $row['sector'] : null,
                'reference'             => $row['reference'] ?  $row['reference'] :  null,
                'employment_status'     => $employment_status,
                'social_security'       => null,
                'company_name'          => $row['company_name'] ?  $row['company_name'] : null,
                'occupation'            => $row['occupation'] ?  $row['occupation'] : null,
                'area_id'               => Null,
                'campaign_id'           => Null,
                'created_at'            => $registrationDate,
            ];

            Lead::create($createData);
        }
    }
}
