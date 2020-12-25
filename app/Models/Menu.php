<?php
namespace App\Models;

use Eloquent;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\QueryBuilder;
use Kalnoy\Nestedset\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
 * @property-read Collection|Menu[] $children
 * @property-read int|null $children_count
 * @property-read mixed $resource_url
 * @property-read MenuItemType|null $menuItemType
 * @property Menu|null $parent
 * @method static Collection|static[] all($columns = ['*'])
 * @method static Builder|Menu d()
 * @method static Collection|static[] get($columns = ['*'])
 * @method static QueryBuilder|Menu newModelQuery()
 * @method static QueryBuilder|Menu newQuery()
 * @method static QueryBuilder|Menu query()
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
 * @method static QueryBuilder|Menu ancestorsAndSelf($id, array $columns = [])
 * @method static QueryBuilder|Menu ancestorsOf($id, array $columns = [])
 * @method static QueryBuilder|Menu applyNestedSetScope(?string $table = null)
 * @method static QueryBuilder|Menu countErrors()
 * @method static QueryBuilder|Menu defaultOrder(string $dir = 'asc')
 * @method static QueryBuilder|Menu descendantsAndSelf($id, array $columns = [])
 * @method static QueryBuilder|Menu descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static QueryBuilder|Menu fixSubtree($root)
 * @method static QueryBuilder|Menu fixTree($root = null)
 * @method static QueryBuilder|Menu getNodeData($id, $required = false)
 * @method static QueryBuilder|Menu getPlainNodeData($id, $required = false)
 * @method static QueryBuilder|Menu getTotalErrors()
 * @method static QueryBuilder|Menu hasChildren()
 * @method static QueryBuilder|Menu hasParent()
 * @method static QueryBuilder|Menu isBroken()
 * @method static QueryBuilder|Menu leaves(array $columns = [])
 * @method static QueryBuilder|Menu makeGap(int $cut, int $height)
 * @method static QueryBuilder|Menu moveNode($key, $position)
 * @method static QueryBuilder|Menu orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static QueryBuilder|Menu orWhereDescendantOf($id)
 * @method static QueryBuilder|Menu orWhereNodeBetween($values)
 * @method static QueryBuilder|Menu orWhereNotDescendantOf($id)
 * @method static QueryBuilder|Menu rebuildSubtree($root, array $data, $delete = false)
 * @method static QueryBuilder|Menu rebuildTree(array $data, $delete = false, $root = null)
 * @method static QueryBuilder|Menu reversed()
 * @method static QueryBuilder|Menu root(array $columns = [])
 * @method static QueryBuilder|Menu whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static QueryBuilder|Menu whereAncestorOrSelf($id)
 * @method static QueryBuilder|Menu whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static QueryBuilder|Menu whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static QueryBuilder|Menu whereIsAfter($id, $boolean = 'and')
 * @method static QueryBuilder|Menu whereIsBefore($id, $boolean = 'and')
 * @method static QueryBuilder|Menu whereIsLeaf()
 * @method static QueryBuilder|Menu whereIsRoot()
 * @method static QueryBuilder|Menu whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static QueryBuilder|Menu whereNotDescendantOf($id)
 * @method static QueryBuilder|Menu withDepth(string $as = 'depth')
 * @method static QueryBuilder|Menu withoutRoot()
 */
class Menu extends Model
{
    use NodeTrait;

    protected $table = 'menu';
    public $timestamps = false;
    protected $fillable = [
        'parent_id',
//        'menu_item_type_id',
        'menuItemType',
        'name',
        'css_class',
        'icon',
        'fa_icon',
        'url',
        'lft',
        'rgt',
        'lvl',
        'api_enabled',
        'is_published',
    ];
    protected $with     = ['menuItemType'];
    protected $appends = ['resource_url'];

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id','id');
    }

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
        return url('/admin/menu/'.$this->getKey());
    }
}
