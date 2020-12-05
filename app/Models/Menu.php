<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Kalnoy\Nestedset\Collection;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\QueryBuilder;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $menu_item_type_id
 * @property mixed $name
 * @property string|null $icon
 * @property string|null $fa_icon
 * @property string|null $url
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property int $api_enabled
 * @property int $is_published
 * @property-read mixed $resource_url
 * @method static Builder|Menu newModelQuery()
 * @method static Builder|Menu newQuery()
 * @method static Builder|Menu query()
 * @method static Builder|Menu whereApiEnabled($value)
 * @method static Builder|Menu whereFaIcon($value)
 * @method static Builder|Menu whereIcon($value)
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereIsPublished($value)
 * @method static Builder|Menu whereLft($value)
 * @method static Builder|Menu whereLvl($value)
 * @method static Builder|Menu whereMenuItemTypeId($value)
 * @method static Builder|Menu whereName($value)
 * @method static Builder|Menu whereParentId($value)
 * @method static Builder|Menu whereRgt($value)
 * @method static Builder|Menu whereUrl($value)
 * @mixin Eloquent
 */
class Menu extends Model
{
    use NodeTrait;

    protected $table = 'menu';
    protected $fillable = [
        'parent_id',
//        'menu_item_type_id',
        'menuItemType',
        'name',
        'icon',
        'fa_icon',
        'url',
        'lft',
        'rgt',
        'lvl',
        'api_enabled',
        'is_published',
    ];
    public $timestamps = false;
//    protected $fillable = ['parent_id','name','lvl','lft','rgt','url','menuItemType','is_published'];
    protected $with     = ['menuItemType'];
    protected $appends = ['resource_url'];

    public function menuItemType()
    {
        return $this->belongsTo(MenuItemType::class);
    }

    public function getLftName()
    {
        return 'lft';
    }

    public function getRgtName()
    {
        return 'rgt';
    }

    public function getDepthName()
    {
        return 'lvl';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/menus/'.$this->getKey());
    }
}
