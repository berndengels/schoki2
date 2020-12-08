<?php

namespace App\Libs;

use App\Models\Category;
use App\Models\Theme;
use App\Repositories\PageRepository;
use Route;

/**
 * App\Libs\Routes
 */
class Routes
{
	/**
	 * @var array
	 */
	public static $routes = [];

	public static function getRoutes( $prefix = null )
	{
		$routes = collect(Route::getRoutes()->getRoutesByName());

		if( $prefix ) {
			$routes = $routes->reject(function ($value, $key) use ($prefix) {
				return !preg_match("#$prefix#", $key);
			});
		}

		foreach($routes as $k => $r) {
			if( !preg_match("/\{[^\}]+\}/", $r->uri) ) {
				$uri = '/'.ltrim($r->uri,'/');
				self::$routes[$uri] = $uri;
			}
		}

		self::$routes = collect(self::$routes);
		return self::$routes;
	}

	public static function getPageRoutes()
	{
		return collect(PageRepository::getRoutes());
	}

	public static function getCategoryRoutes() {
        return Category::all()
            ->pluck('slug')
            ->mapWithKeys(function ($item) {
                return ["/category/$item" => "/category/$item"];
            });

    }

    public static function getStaticRoutes()
    {
        $staticRoutes = [];
        collect(config('view.paths'))->map(function($path) use (&$staticRoutes) {
            $path = $path . '/public/static';
            if(is_dir($path)) {
                foreach(scandir($path) as $item) {
                    if(false !== strrpos($item, '.blade.php')) {
                        $value = '/static/' . basename($item,'.blade.php');
                        $staticRoutes[$value] = $value;
                    }
                }
            }
        });
        return $staticRoutes;
    }

    public static function getThemeRoutes() {
        return Theme::all()->pluck('slug')
            ->mapWithKeys(function ($item) {
                return ["/theme/$item" => "/theme/$item"];
            });
    }

	public static function getPublicRoutes()
	{
        return self::getPageRoutes()
            ->merge(self::getRoutes('public'))
            ->merge(self::getCategoryRoutes())
            ->merge(self::getThemeRoutes())
            ->merge(self::getStaticRoutes());
	}
}
