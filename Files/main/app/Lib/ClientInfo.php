<?php

namespace App\Lib;

class ClientInfo{

    /**
    * Get requestor IP information
    *
    * @return array
    */
	public static function ipInfo()
	{
	    $ip = getRealIP();

		try {
			$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);
		} catch (\Throwable $e) {
			$xml = false;
		}

	    $country = ($xml && isset($xml->geoplugin_countryName)) ? $xml->geoplugin_countryName : '';
        $city    = ($xml && isset($xml->geoplugin_city)) ? $xml->geoplugin_city : '';
        $area    = ($xml && isset($xml->geoplugin_areaCode)) ? $xml->geoplugin_areaCode : '';
        $code    = ($xml && isset($xml->geoplugin_countryCode)) ? $xml->geoplugin_countryCode : '';
        $long    = ($xml && isset($xml->geoplugin_longitude)) ? $xml->geoplugin_longitude : '';
        $lat     = ($xml && isset($xml->geoplugin_latitude)) ? $xml->geoplugin_latitude : '';

	    $data['country'] = $country ?? [];
	    $data['city'] = $city ?? [];
	    $data['area'] = $area ?? [];
	    $data['code'] = $code ?? [];
	    $data['long'] = $long ?? [];
	    $data['lat'] = $lat ?? [];
	    $data['ip'] = $ip;
	    $data['time'] = date('Y-m-d h:i:s A');


	    return $data;
	}

    /**
    * Get requestor operating system information
    *
    * @return array
    */
	public static function osBrowser(){
	    $userAgent = $_SERVER['HTTP_USER_AGENT'];
	    $osPlatform = "Unknown OS Platform";
	    $osArray = array(
	        '/windows nt 10/i' => 'Windows 10',
	        '/windows nt 6.3/i' => 'Windows 8.1',
	        '/windows nt 6.2/i' => 'Windows 8',
	        '/windows nt 6.1/i' => 'Windows 7',
	        '/windows nt 6.0/i' => 'Windows Vista',
	        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
	        '/windows nt 5.1/i' => 'Windows XP',
	        '/windows xp/i' => 'Windows XP',
	        '/windows nt 5.0/i' => 'Windows 2000',
	        '/windows me/i' => 'Windows ME',
	        '/win98/i' => 'Windows 98',
	        '/win95/i' => 'Windows 95',
	        '/win16/i' => 'Windows 3.11',
	        '/macintosh|mac os x/i' => 'Mac OS X',
	        '/mac_powerpc/i' => 'Mac OS 9',
	        '/linux/i' => 'Linux',
	        '/ubuntu/i' => 'Ubuntu',
	        '/iphone/i' => 'iPhone',
	        '/ipod/i' => 'iPod',
	        '/ipad/i' => 'iPad',
	        '/android/i' => 'Android',
	        '/blackberry/i' => 'BlackBerry',
	        '/webos/i' => 'Mobile'
	    );
	    foreach ($osArray as $regex => $value) {
	        if (preg_match($regex, $userAgent)) {
	            $osPlatform = $value;
	        }
	    }
	    $browser = "Unknown Browser";
	    $browserArray = array(
	        '/msie/i' => 'Internet Explorer',
	        '/firefox/i' => 'Firefox',
	        '/safari/i' => 'Safari',
	        '/chrome/i' => 'Chrome',
	        '/edge/i' => 'Edge',
	        '/opera/i' => 'Opera',
	        '/netscape/i' => 'Netscape',
	        '/maxthon/i' => 'Maxthon',
	        '/konqueror/i' => 'Konqueror',
	        '/mobile/i' => 'Handheld Browser'
	    );
	    foreach ($browserArray as $regex => $value) {
	        if (preg_match($regex, $userAgent)) {
	            $browser = $value;
	        }
	    }

	    $data['os_platform'] = $osPlatform;
	    $data['browser'] = $browser;

	    return $data;
	}

}
