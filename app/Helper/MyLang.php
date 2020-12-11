<?php
namespace App\Helper;

use Jenssegers\Agent\Agent;

class MyLang
{
    public static function getPrimary()
    {
        $agent = new Agent();
        $languages = collect($agent->languages());
        list($lang,) = explode('-', $languages->first());
        return $lang;
    }
}
