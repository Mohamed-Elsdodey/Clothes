<?php


if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('setting')) {
    function setting() {
        return \App\Models\Setting::firstorFail();
    }
}


if (!function_exists('get_file')) {
    function get_file($file)
    {
        // Storage::exists( $file )
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            $file_path = $file;
        } elseif ($file) {
            $file_path = asset('storage/uploads') . '/' . $file;
        } else {
            $file_path = asset('dashboard/assets/images/companies/img-1.png');
        }
        return $file_path;
    }//end
}


function localRowData($model, $id,$column)
{
    $lang = \App\Models\Language::where('abbreviation', app()->getLocale())->first();
    if ($lang) {
        return   $row = $model->where('lang_id', $lang->id)->where($column,$id)->first();

    }
    return null;
}

function rowData($model, $id,$column,$lang_id)
{
    $lang = \App\Models\Language::findOrFail($lang_id);
    if ($lang) {
        return   $row = $model->where('lang_id', $lang->id)->where($column,$id)->first();
    }
    return null;
}
