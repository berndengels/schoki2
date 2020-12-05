<?php
/**
 * HasAdminUser.php
 *
 * @author    Bernd Engels
 * @created   12.03.19 17:27
 * @copyright Bernd Engels
 */

namespace App\Models\Ext;

use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait HasAdminUser
 */
trait HasAdminUser
{
	public static function bootHasAdminUser()
	{
		/**
		 * @var $user AdminUser
		 */
		$user = auth()->user();
		if($user) {
			static::creating(function($table) use ($user)  {
				$table->created_by = $user->id;
			});
            static::updating(function($table) use ($user)  {
                $table->updated_by = $user->id;
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
