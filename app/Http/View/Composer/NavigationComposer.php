<?php
/**
 * NavigationComposer.php
 *
 * @author    Bernd Engels
 * @created   10.04.19 04:27
 * @copyright Bernd Engels
 */

namespace App\Http\View\Composer;

use Illuminate\View\View;
use App\Repositories\MenuRepository;

class NavigationComposer {

	public function compose(View $view)
	{
	    $repo = new MenuRepository();
		$view->with('topMenu', $repo->getTopMenu());
		$view->with('bottomMenu', $repo->getBottomMenu());
	}
}
