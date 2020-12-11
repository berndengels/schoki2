<?php

namespace App\Models;

use App\Helper\MyLang;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $code
 * @property string $en
 * @property string $de
 * @property string $es
 * @property string $fr
 * @property string $it
 * @property string $ru
 * @property-read mixed $name
 * @property-read mixed $resource_url
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereEs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereRu($value)
 * @mixin \Eloquent
 */
class Country extends Model
{
    protected $table = 'countries';
    public $timestamps = false;
    protected $appends = ['resource_url','name'];
    protected $fillable = [
        'code',
        'en',
        'de',
        'es',
        'fr',
        'it',
        'ru',
    ];

    public function getNameAttribute()
    {
        $language = MyLang::getPrimary();
        if($language) {
            return $this->$language;
        }
        return $this->de;
    }

    public function __toString()
    {
        return $this->name;
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/countries/'.$this->getKey());
    }
}
