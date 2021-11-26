<?php
use Carbon\Carbon;

if(!function_exists('encodeImage')) {
    function encodeImage($file_input)
    {
        return Carbon::now('Asia/Ho_Chi_Minh')->toDateString().$file_input;
    }
}

if(!function_exists('showImage')) {
    function showImage($folder_name, $file_name)
    {
        if($file_name == '' || $file_name == 'image-default' || $file_name == 'undefined') {
            return 'https://static.thenounproject.com/png/104062-200.png';
        }
        return asset("storage/$folder_name/$file_name");
    }
}