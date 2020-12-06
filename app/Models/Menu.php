<?php
namespace App\Models;

use Eloquent;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Menu
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
