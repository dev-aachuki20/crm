<?php
use Illuminate\Support\Facades\Auth;


/* Labels use for only blade file content title */
if (!function_exists('sectorWiseLabel')) {
    function sectorWiseLabel($option)
    {
        try {
            if(isset($option)){
                $user = Auth::user();
                if(isset($user)){
                    app()->setLocale($user->language);
                    return trans("labels.$option");
                }
            }
            return trans("labels.$option");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}