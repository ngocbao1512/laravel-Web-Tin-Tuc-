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

if(!function_exists('get_client_ip')) {
    function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            } else {
                if (getenv('HTTP_X_FORWARDED')) {
                    $ipaddress = getenv('HTTP_X_FORWARDED');
                } else {
                    if (getenv('HTTP_FORWARDED_FOR')) {
                        $ipaddress = getenv('HTTP_FORWARDED_FOR');
                    } else {
                        if (getenv('HTTP_FORWARDED')) {
                            $ipaddress = getenv('HTTP_FORWARDED');
                        } else {
                            if (getenv('REMOTE_ADDR')) {
                                $ipaddress = getenv('REMOTE_ADDR');
                            } else {
                                $ipaddress = 'UNKNOWN';
                            }
                        }
                    }
                }
            }
        }

        return $ipaddress;
    }
}
