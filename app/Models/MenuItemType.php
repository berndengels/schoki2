<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuItemType
 *
 * @property int $id
 * @property string $type
 * @property string $label
 * @method static Builder|MenuItemType newModelQuery()
 * @method static Builder|MenuItemType newQuery()
 * @method static Builder|MenuItemType query()
 * @method static Builder|MenuItemType whereId($value)
 * @method static Builder|MenuItemType whereLabel($value)
 * @method static Builder|MenuItemType whereType($value)
 * @mixin Eloquent
 */
class MenuItemType extends Model
{
    protected $table = 'menu_item_type';
    protected $fillable = [
        'type',
        'label',
    ];
    public $timestamps = false;
}
