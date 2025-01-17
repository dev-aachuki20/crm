<?php

use Illuminate\Support\Str as Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Uploads;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Models\Lead;


if (!function_exists('convertToFloat')) {
    function convertToFloat($value)
    {
        if (is_numeric($value)) {
            return number_format((float)$value, 2, '.', ' ');
        }
        return $value;
    }
}

if (!function_exists('convertToFloatNotRound')) {
    function convertToFloatNotRound($value)
    {
        if (is_numeric($value)) {
            $dec = 2;
            return number_format(floor($value * pow(10, $dec)) / pow(10, $dec), $dec);
        }
        return $value;
    }
}

if (!function_exists('uploadImage')) {
    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    function uploadImage($directory, $file, $folder, $type = "profile", $fileType = "jpg", $actionType = "save", $uploadId = null, $orientation = null)
    {
        $oldFile = null;
        if ($actionType == "save") {
            $upload                       = new Uploads;
        } else {
            $upload                       = Uploads::find($uploadId);
            $oldFile = $upload->file_path;
        }
        $upload->file_path          = $file->store($folder, 'public');
        $upload->extension          = $file->getClientOriginalExtension();
        $upload->original_file_name = $file->getClientOriginalName();
        $upload->type                 = $type;
        $upload->file_type             = $fileType;
        $upload->orientation         = $orientation;
        $response                     = $directory->uploads()->save($upload);
        // delete old file
        if ($oldFile) {
            Storage::disk('public')->delete($oldFile);
        }
        return $upload;
    }
}

if (!function_exists('deleteFile')) {
    /**
     * Destroy Old Image.	 *
     * @param int $id
     */
    function deleteFile($upload_id)
    {
        $upload = Uploads::find($upload_id);
        Storage::disk('public')->delete($upload->file_path);
        $upload->delete();
        return true;
    }
}


if (!function_exists('CurlPostRequest')) {
    function CurlPostRequest($url, $headers, $postFields)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => $headers,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}

if (!function_exists('CurlGetRequest')) {
    function CurlGetRequest($url, $headers)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}

if (!function_exists('getCommonValidationRuleMsgs')) {
    function getCommonValidationRuleMsgs()
    {
        return [
            'password.required' => 'The new password is required.',
            'password.min' => 'The new password must be at least 8 characters',
            'password.different' => 'The new password and current password must be different.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password_confirmation.required' => 'The new password confirmation is required.',
            'password_confirmation.min' => 'The new password confirmation must be at least 8 characters',
            'email.required' => 'Please enter email address.',
            'email.email' => 'Email is not valid. Enter email address for example test@gmail.com',
        ];
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 20)
    {

        $randomString = Str::random($length);

        return $randomString;
    }
}

if (!function_exists('convertDateTimeFormat')) {
    function convertDateTimeFormat($value, $type = 'date')
    {
        $changeFormatValue = Carbon::parse($value);
        if ($type == 'date') {
            return $changeFormatValue->format(config('constants.date_format'));
        } else if ($type == 'datetime') {
            return $changeFormatValue->format(config('constants.datetime_format'));
        } else if ($type == 'fulldatetime') {
            return $changeFormatValue->format(config('constants.full_date_time'));
        } else if ($type == 'fulldate') {
            return $changeFormatValue->format(config('constants.full_date_format'));
        } else if ($type == 'date_month_year') {
            return $changeFormatValue->format(config('constants.date_month_year'));
        }
        return $changeFormatValue;
    }
}


if (!function_exists('generateOTP')) {
    function generateOTP()
    {
        return rand(1000, 9999);
    }
}

if (!function_exists('getDecryptSlug')) {
    function getDecryptSlug($encryptSlug)
    {
        try {
            $id = last(explode('-', $encryptSlug));
            return decrypt($id);
        } catch (DecryptException $e) {
            return false;
        }
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        $result = null;
        $setting = Setting::where('key', $key)->where('status', 1)->first();
        if ($setting) {
            if ($setting->type == 'image') {
                $result = $setting->image_url;
            } elseif ($setting->type == 'video') {
                $result = $setting->video_url;
            } else {
                $result = $setting->value;
            }
        }
        return $result;
    }
}

if (!function_exists('getSettingByGroup')) {
    function getSettingByGroup($groupkey)
    {
        $settings = Setting::select('id', 'key', 'value')->where('group', $groupkey)->where('status', 1)->get();
        if ($settings->count() > 0) {
            foreach ($settings as $setting) {
                if ($setting->type == 'image') {
                    $setting->image_url = $setting->image_url;
                } elseif ($setting->type == 'video') {
                    $setting->image_url = $setting->video_url;
                }
            }
        }
        return $settings;
    }
}


// if (!function_exists('getDatatableLang')) {
//     function getDatatableLang($language)
//     {
//         $settings = Setting::select('id', 'key', 'value')->where('group', $groupkey)->where('status', 1)->get();
//         if ($settings->count() > 0) {
//             foreach ($settings as $setting) {
//                 if ($setting->type == 'image') {
//                     $setting->image_url = $setting->image_url;
//                 } elseif ($setting->type == 'video') {
//                     $setting->image_url = $setting->video_url;
//                 }
//             }
//         }
//         return $settings;
//     }
// }



// dynamic button and views rendering.
if (!function_exists('datatableButton')) {
    function datatableButton($type, $data, $permission)
    {
        if ($type == 'edit') {
            return view('layouts.includes.partials.datatable_action.edit_action', ['data' => $data, 'canEdit' => $permission])->render();
        } elseif ($type == 'delete') {
            return view('layouts.includes.partials.datatable_action.delete_action', ['data' => $data, 'canDelete' => $permission])->render();
        }
        return '';
    }
}

if (!function_exists('getKeyByValue')) {

    // function getKeyByValue($variable, $array, $value)
    // {
    //     foreach ($array as $key => $val) {
    //         $v = __('cruds.' . $variable . '.' . $val);

    //         if ($v === $value) {
    //             return  $key;
    //         }
    //     }
    //     return null; // Return null or handle case when value is not found
    // }

    function getKeyByValue($variable, $array, $array2, $value)
    {
        // foreach ($array as $key => $val) {
        //     // Compare localized value with the target value
        //     if ($val === $value) {
        //         // return $key;
        //         $constants = config('constants.civil_status');
        //         return array_search($key, $constants);
        //     }
        // }


        // First, search in the English array
        foreach ($array as $key => $val) {
            if ($val === $value) {
                if ($variable == 'civil_status') {
                    $constants = config('constants.civil_status');
                } elseif ($variable == 'employment_status') {
                    $constants = config('constants.employment_status');
                } elseif ($variable == 'identification_type') {
                    $constants = config('constants.identification_type');
                }
                return array_search($key, $constants);
            }
        }

        // If not found, search in the Spanish array
        foreach ($array2 as $key => $val) {
            if ($val === $value) {
                if ($variable == 'civil_status') {
                    $constants = config('constants.civil_status');
                } elseif ($variable == 'employment_status') {
                    $constants = config('constants.employment_status');
                } elseif ($variable == 'identification_type') {
                    $constants = config('constants.identification_type');
                }
                return array_search($key, $constants);
            }
        }
        return null; // Return null if value is not found
    }
}