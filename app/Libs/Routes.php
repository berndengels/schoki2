<?php
namespace App\Libs;

use Route;
use App\Models\Theme;
use App\Models\Category;
use App\Repositories\PageRepository;

/**
 * App\Libs\Routes
 */
class Routes
{
	/**
	 * @var array
	 */
	private static $routes = [];

    private static function getDefaultDomain() {
        return env('APP_DOMAIN');
    }

	public static function getRoutes($protocol, $defaultDomain, $prefix = null )
	{
		$routes = collect(Route::getRoutes()->getRoutesByName());

		if( $prefix ) {
			$routes = $routes->reject(function ($value, $key) use ($prefix) {

				return !preg_match("#$prefix#", $key);
			});
		}
        /**
         * @var \Illuminate\Routing\Route $r
         */
		foreach($routes as $k => $r) {
            $subdomain = $r->getDomain();
            if( !preg_match("/\{[^\}]+\}/", $r->uri) ) {
                $key = ltrim($r->uri,'/');
                if($subdomain) {
                    $uri = $subdomain. '/'.ltrim($r->uri,'/');
                } else {
                    $uri = $defaultDomain.'/'.ltrim($r->uri,'/');
                }
				self::$routes[$key] = $protocol.$uri;
			}
		}

		self::$routes = collect(self::$routes);
		return self::$routes;
	}

	public static function getPageRoutes($protocol, $defaultDomain)
	{
		return collect(PageRepository::getRoutes($protocol, $defaultDomain));
	}

	public static function getCategoryRoutes($protocol, $defaultDomain) {
        return Category::all()
            ->pluck('slug')
            ->mapWithKeys(function ($item) use($protocol, $defaultDomain) {
                return ["/category/$item" => "{$protocol}{$defaultDomain}/category/$item"];
            });

    }

    public static function getStaticRoutes($protocol, $defaultDomain)
    {
        $staticRoutes = [];
        collect(config('view.paths'))->map(function($path) use (&$staticRoutes, $protocol, $defaultDomain) {
            $path = $path . '/public/static';
            if(is_dir($path)) {
                foreach(scandir($path) as $item) {
                    if(false !== strrpos($item, '.blade.php')) {
                        $key = '/static/' . basename($item,'.blade.php');
                        $staticRoutes[$key] = $protocol.$defaultDomain.$key;
                    }
                }
            }
        });
        return $staticRoutes;
    }

    public static function getThemeRoutes($protocol, $defaultDomain) {
        return Theme::all()->pluck('slug')
            ->mapWithKeys(function ($item) use ($protocol, $defaultDomain) {
                return ["/theme/$item" => "$protocol$defaultDomain/theme/$item"];
            });
    }

	public static function getPublicRoutes()
	{
        $protocol       = env('REDIRECT_HTTPS') ? 'https://' : 'http://';
        $defaultDomain  = self::getDefaultDomain();

        return self::getPageRoutes($protocol, $defaultDomain)
            ->merge(self::getRoutes($protocol, $defaultDomain, 'public'))
            ->merge(self::getCategoryRoutes($protocol, $defaultDomain))
            ->merge(self::getThemeRoutes($protocol, $defaultDomain))
            ->merge(self::getStaticRoutes($protocol, $defaultDomain));
	}
}
