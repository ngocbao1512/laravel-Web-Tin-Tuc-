<?php
use Carbon\Carbon;

if(!function_exists('encodeImage')) {
    function encodeImage($filename_input)
    {
        return Carbon::now('Asia/Ho_Chi_Minh')->toDateString().$filename_input->hashName();
    }
}