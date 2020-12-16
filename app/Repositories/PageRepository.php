<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Facades\DB;

class PageRepository {

    public static function getRoutes($protocol, $defaultDomain) {
        $result = Page::select(DB::raw('CONCAT("/page/",slug) AS route'))
			->where('is_published','=', 1)
			->get('route');

		$result = $result->mapWithKeys(function ($item) use ($protocol, $defaultDomain) {
			return [$item->route => $protocol.$defaultDomain.$item->route];
		});
        return $result;
    }
}
