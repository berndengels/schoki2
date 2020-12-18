<?php
namespace App\Helper;

use Jenssegers\Agent\Agent;

class MyLang
{
    public static function getPrimary()
    {
        /**
         * @var Agent
         */
        $agent = new Agent();
        $languages = collect($agent->languages());
        list($lang,) = explode('-', $languages->first());
        return $lang;
    }

    public static function getLocale()
    {
        $lang = self::getPrimary();
        return $lang . '_' . strtoupper($lang);
    }

    public static function getLocaleRfc5646()
    {
        $lang = self::getPrimary();
        return $lang . '-' . strtoupper($lang);
    }
}
