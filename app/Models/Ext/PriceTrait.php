<?php
/**
 * HasCustomer.php
 *
 * @author    Bernd Engels
 * @created   12.03.19 17:27
 * @copyright Bernd Engels
 */
namespace App\Models\Ext;

use App\Helper\MyMoney;

/**
 * Trait HasCustomer
 */
trait PriceTrait
{
	public static function bootPriceTrait()
	{
        static::creating(function($table) {
            $table->price_netto = self::getNetto($table->price);
        });
        static::updating(function($table) {
            $table->price_netto = self::getNetto($table->price);
        });
        static::saving(function($table) {
            $table->price_netto = self::getNetto($table->price);
        });
	}

	public static function getNetto($brutto) {
	    return MyMoney::getNetto($brutto);
    }

    public static function getBrutto($netto) {
        return MyMoney::getBrutto($netto);
    }
}
