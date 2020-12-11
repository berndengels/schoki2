<?php
/**
 * HasCustomer.php
 *
 * @author    Bernd Engels
 * @created   12.03.19 17:27
 * @copyright Bernd Engels
 */
namespace App\Models\Ext;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait HasCustomer
 */
trait HasCustomer
{
	public static function bootHasCustomer()
	{
		/**
		 * @var $user Customer
		 */
		$user = auth('web')->user();
		if($user) {
			static::creating(function($table) use ($user)  {
				$table->created_by = $user->id;
			});
            static::updating(function($table) use ($user)  {
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
		return $this->belongsTo(Customer::class, 'created_by', 'id');
	}

	/**
	 * @return BelongsTo
	 */
	public function updatedBy()
	{
		return $this->belongsTo(Customer::class, 'updated_by', 'id');
	}
}
