<?php

namespace App\Libraries;

// use CodeIgniter\HTTP\RedirectResponse;

class Helpers
{
    public function reverseString(string $string)
    {
        // Reverse the provided string
        return strrev($string);
    }

    public function sumArray(array $array)
    {
        // Sum the values in the provided array
        return array_sum($array);
    }

    public function formatDate($date, $format)
    {
        // Format the provided date using the provided format string
        return date($format, strtotime($date));
    }

    public function dateDifference($date1, $date2)
    {
        // Calculate the difference in days between the two dates
        $diff = abs(strtotime($date1) - strtotime($date2));

        return floor($diff / (60 * 60 * 24));
    }

    public function arrayToCommaSeparatedString($array, $delimiter = ',')
    {
        // Convert the array to a comma-separated string using the provided delimiter
        return implode($delimiter, $array);
    }

    public function redirectTo(string $url)
    {
        // Redirect the user to the provided URL
        return redirect($url);
    }

    public function generateRandomString($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    //
    public function truncateString($string, $length)
    {
        // Truncate the string to the maximum length and append an ellipsis
        if (strlen($string) > $length) {
            $string = substr($string, 0, $length - 3) . '...';
        }

        return $string;
    }

    //
    public function strReplace($search, $replace, $str)
    {
        if (!empty($str)) {
            return str_replace($search, $replace, $str);
        }
    }

    //
    public function isEmail($string)
    {
        // Check if the string is a valid email address using a regular expression
        return (bool) preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i', $string);
    }

    //
    public function validateIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        } else {
            return false;
        }
    }

    //
    public function sanitizeString($string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    //
    public function sanitizeEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    //
    public function validateEmail($email)
    {
        // Use the filter_var() function with the FILTER_VALIDATE_EMAIL filter
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        // Check if the email address is valid
        if ($email === false) {
            // The email address is not valid
            return false;
        } else {
            // The email address is valid
            return true;
        }
    }

    //
    public function sanitizeUrl($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    //
    public function validateUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    //
    public function sanitizeArray($array)
    {
        return filter_var($array, FILTER_SANITIZE_ENCODED);
    }

    //
    public function validateInt($int)
    {
        return (bool) filter_var($int, FILTER_VALIDATE_INT);
    }

    //
    public function generateEstimatedReadingTimeMinutes($content, $removeBreaks = false) {
        $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $content);
        $string = strip_tags($content);

        if ($removeBreaks) {
            $string = preg_replace( '/[\r\n\t ]+/', ' ', $string);
        }

        // 200 is the approximate estimated words per minute across languages.
        $words_per_minute = 200;
        $words            = str_word_count($string);
        $output = (int) round($words / $words_per_minute);

        if ($output == 0) { 
            $suffix = ' ' . trans('minute');  
        } elseif ($output == 1) { 
            $suffix = ' ' . trans('minute');
        } else { 
            $suffix = ' ' . trans('minutes');
        }
        
        return $output . $suffix;
    }

    //
    public function getImageExtension($name)
    {
        $ext = "";
        if (!empty($name)) {
            $ext = pathinfo($name, PATHINFO_EXTENSION);
        }
        if (!empty($ext)) {
            $ext = strtolower($ext);
        }

        if (!empty($ext)) {
            switch ($ext) {
                case 'jpg':
                    return 'image/jpeg';
                    break;

                case 'png':
                    return 'image/png';
                    break;

                case 'webp':
                    return 'image/webp';
                    break;
                
                default:
                    return 'image/jpeg';
                    break;
            }
        }
    }

    //
    public function getRandomUserAgent() {
        $agents = array(
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36",
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8",
            "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36",
            "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0",
            "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:55.0) Gecko/20100101 Firefox/55.0",
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko",
            "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0",
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0",
            "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36",
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36 Edge/15.15063",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:55.0) Gecko/20100101 Firefox/55.0",
            "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36"
        );
        
        $rand = rand(0, count($agents) - 1);

        return trim($agents[$rand]);
    }

    //
    public function isLocalhost() {
        if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1' || $_SERVER['REMOTE_ADDR'] == 'localhost') {
            return true;
        } else {
            return false;
        }
    }

    //
    public function getWebServer() {
        if (isset( $_SERVER['SERVER_SOFTWARE'])) {
            $serverSoftware = strtolower($_SERVER['SERVER_SOFTWARE']);
        } else {
            $serverSoftware = '';
        }

        if (false !== strpos($serverSoftware, 'apache')) {
            $server = 'Apache';
        } else if (false !== strpos($serverSoftware, 'nginx')) {
            $server = 'Nginx';
        } else if (false !== strpos($serverSoftware, 'litespeed')) {
            $server = 'litespeed';
        } else if (false !== strpos($serverSoftware, 'thttpd')) {
            $server = 'thttpd';
        } else if (false !== strpos($serverSoftware, 'microsoft-iis')) {
            $server = 'IIS';
        } else {
            $server = 'apache';
        }

        return $server;
    }

    //
    function insertAds($text, $ads) {
        $paragraphs = explode('</p>', $text);
        $new_paragraphs = [];
        $index = 0;
        foreach ($paragraphs as $p) {
            $new_paragraphs[] = $p;
            if (($index+1) % 3 == 0) {
                $new_paragraphs[] = $ads;
            }
            $index++;
        }

        return implode('</p>', $new_paragraphs);
    }

    public function stringToArray($input) {
        $output = array();
        $string_data = explode(',' ,$input);
        foreach ($string_data as $value) {
            array_push($output, $value);
        }
        return $output;
    }

   

    /*function stringToArray($string) {
        $array = explode(',', $string);

        return $array;
    }

    function generate_ids_string_categories($array)
    {
        if (empty($array)) {
            return "0";
        } else {
            $array_new = array();
            foreach ($array as $item) {
                if (!empty($item)) {
                    array_push($array_new, $item->name);
                }
            }
            return $array_new;
        }
    }*/
}
