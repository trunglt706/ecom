<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class System extends Model {

    /*
    |--------------------------------------------------------------------------
    | Global functions
    |--------------------------------------------------------------------------
    |
    */
    public static $continents = [
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    ];

    public static function getValue($code, $attrib = null){
        $attribs = json_decode(self::Where('code', $code)->value('attribs'));
        if(is_null($attrib)) return $attribs;
        if(isset($attribs->$attrib)) return $attribs->$attrib;
        return '';
    }

    public static function getDate($date = null){
        $dateformat = 'dateformat_'.\App::getLocale();
        if(is_null($date)) return date(self::getValue('system')->$dateformat, time());
        return date(self::getValue('system')->$dateformat, strtotime($date));
    }

    public static function inttostr($num, $del = ","){
        if($num < 1000) return $num;
        return self::inttostr( ($num - (fmod($num , 1000)))/1000 ).$del.str_pad(fmod($num , 1000),3,'0',STR_PAD_LEFT);;
    }

    public static function ip_log(){
        if(\Cookie::get('any') == ''){
            $ip_info = self::ip_info();
            if(is_array($ip_info)){
                $counter = self::getValue('counter');
                foreach (self::$continents as $continent_code => $continent_name) {
                    if($continent_code == $ip_info['continent_code']){
                        $counter->$continent_code ++;
                        $counter->total ++;
                        self::Where('code', 'counter')->update([
                            'attribs' => json_encode($counter)
                        ]);
                        break;
                    }
                }
            }
        }
    }
    public static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "ip"             => $ip,
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @self::$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    // statistic
    public static function _count($table, $arr = []){
        $query = \DB::table($table);
        foreach($arr as $col=>$val){
            $query->where($col, $val);
        }
        return $query->count();
    }

}
