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

// input 2021-11-25 
// output 25/11/2021
if(!function_exists('changeTime')) {
    function changeTime($time_string)
    {
        // dao chuoi -> change - to /  
        $result = substr($time_string,0,-8)."/".substr($time_string,5,2)."/".substr($time_string,0,4);
        return $result;
    }
}