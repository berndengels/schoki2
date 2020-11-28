<?php
/**
 * Userable.php
 *
 * @author    Bernd Engels
 * @created   12.03.19 17:27
 * @copyright Webwerk Berlin GmbH
 */

namespace App\Models\Ext;

use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait HasAdminUser
 */
trait HasAdminUser
{
	public static function bootHasUser()
	{
		/**
		 * @var $user AdminUser
		 */
		$user = auth()->user();
		if($user) {
			static::creating(function($table) use ($user)  {
				$table->created_by = $user->id;
			});
			static::saving(function($table) use ($user) {
				if( $table->id > 0 ) {
					$table->updated_by = $user->id;
				} else {
					$table->created_by = $user->id;
				}
			});
		}
	}

	/**
	 * @return BelongsTo
	 */
	public function createdBy()
	{
		return $this->belongsTo(AdminUser::class, 'created_by', 'id');
	}

	/**
	 * @return BelongsTo
	 */
	public function updatedBy()
	{
		return $this->belongsTo(AdminUser::class, 'updated_by', 'id');
	}
}
