<?php

use App\Lib\ClientInfo;
use App\Lib\FileManager;
use App\Models\Setting;
use App\Notify\Notify;
use Carbon\Carbon;
use Illuminate\Support\Str;

function systemDetails()
{
    $system['name']          = 'Invento Test';
    $system['version']       = '1.0';
    $system['build_version'] = '0.0.1';
    return $system;
}

function verificationCode($length) {
    if ($length <= 0) return 0;
    $min = pow(10, $length - 1);
    $max = (int) ($min - 1).'9';
    return random_int($min,$max);
}

function navigationActive($routeName, $type = null, $param = null) {
    if ($type == 1) $class = 'active';
    else $class = 'active show';

    if (is_array($routeName)) {
        foreach ($routeName as $key => $name) {
            if (request()->routeIs($name)) return $class;
        }
    } elseif (request()->routeIs($routeName)) {
        if ($param) {
            $routeParam = array_values(request()->route()->parameters ?? []);
            if (isset($routeParam[0]) && strtolower($routeParam[0]) == strtolower($param)) return $class;
            else return;
        }
        return $class;
    }
}

function bs($fieldName = null) {
    $setting = cache()->get('setting');

    if (!$setting) {
        $setting = Setting::first();
        cache()->put('setting', $setting);
    }

    return $fieldName ? $setting->$fieldName : $setting;
}

function fileUploader($file, $location, $size = null, $old = null, $thumb = null) {
    $fileManager = new FileManager($file);
    $fileManager->path = $location;
    $fileManager->size = $size;
    $fileManager->old = $old;
    $fileManager->thumb = $thumb;
    $fileManager->upload();
    return $fileManager->filename;
}

function fileManager() {
    return new FileManager();
}

function getFilePath($key) {
    return fileManager()->$key()->path;
}

function getFileSize($key) {
    return fileManager()->$key()->size;
}

function getImage($image, $size = null, $avatar = false) {    
    if (file_exists($image) && is_file($image)) return asset($image);

    return $avatar ? asset('assets/universal/images/avatar.png') : ($size ? route('placeholder.image', $size) : asset('assets/universal/images/default.png'));
}

function isImage($string) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    return in_array(pathinfo($string, PATHINFO_EXTENSION), $allowedExtensions);
}

function isHtml($string) {
    return (bool) preg_match('/<.*?>/', $string);
}

function getPaginate($paginate = 0) {
    return $paginate ? $paginate :  bs('per_page_item');
}

function paginateLinks($data) {
    return $data->appends(request()->all())->links();
}

function activeTheme($asset = false) {
    $theme = bs('active_theme');
    if ($asset) return 'assets/themes/' . $theme . '/';
    return 'themes.' . $theme . '.';
}

function removeElement($array, $value) {
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function notify($user, $templateName, $shortCodes = null, $sendVia = null) {
    $setting          = bs();
    $globalShortCodes = [
        'site_name'       => $setting->site_name,
        'site_currency'   => $setting->site_cur,
        'currency_symbol' => $setting->cur_sym,
    ];

    if (gettype($user) == 'array') {
        $user = (object) $user;
    }

    $shortCodes          = array_merge($shortCodes ?? [], $globalShortCodes);
    $toast               = new Notify($sendVia);
    $toast->templateName = $templateName;
    $toast->shortCodes   = $shortCodes;
    $toast->user         = $user;
    $toast->userColumn   = isset($user->id) ? $user->getForeignKey() : 'user_id';
    $toast->send();
}

function showDateTime($date, $format = null) {
    return $format ? Carbon::parse($date)->translatedFormat($format) : Carbon::parse($date)->translatedFormat(bs('date_format') . ' h:i A');
}

function getIpInfo() {
    $ipInfo = ClientInfo::ipInfo();
    return $ipInfo;
}

function osBrowser() {
    $osBrowser = ClientInfo::osBrowser();
    return $osBrowser;
}

function getRealIP() {
    $ip = $_SERVER["REMOTE_ADDR"];

    $headers = ['HTTP_FORWARDED','HTTP_FORWARDED_FOR','HTTP_X_FORWARDED_FOR','HTTP_CLIENT_IP','HTTP_X_REAL_IP','HTTP_CF_CONNECTING_IP'];

    foreach ($headers as $header) {
        if (!empty($_SERVER[$header]) && filter_var($_SERVER[$header], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER[$header];
        }
    }

    return $ip == '::1' ? '127.0.0.1' : $ip;
}

function slug($string) {
    return Illuminate\Support\Str::slug($string);
}

function showEmailAddress($email) {
    $endPosition = strpos($email, '@') - 1;
    return substr_replace($email, '***', 1, $endPosition);
}

function getTrx($length = 12) {
    $characters       = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString     = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
    return $randomString;
}

function diffForHumans($date) {
    return Carbon::parse($date)->diffForHumans();
}

function toastBack(string $type, string $message) {
    $toast[] = [$type, $message];
    return back()->withToasts($toast);
}

function showAmount($amount, $decimal = 0, $separate = true, $exceptZeros = false): string
{
    $decimal   = $decimal ?: 2;
    $separator = '';

    if ($separate) $separator = ',';

    $printAmount = number_format($amount, $decimal, '.', $separator);

    if ($exceptZeros) {
        $exp = explode('.', $printAmount);

        if ($exp[1] * 1 == 0) $printAmount = $exp[0];
        else $printAmount = rtrim($printAmount, '0');
    }

    return $printAmount;
}

function keyToTitle($text): string
{
    return ucwords(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}