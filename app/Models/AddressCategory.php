<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AddressCategory
 *
 * @property int $id
 * @property int $tag_id
 * @property string $name
 * @method static Builder|AddressCategory newModelQuery()
 * @method static Builder|AddressCategory newQuery()
 * @method static Builder|AddressCategory query()
 * @method static Builder|AddressCategory whereId($value)
 * @method static Builder|AddressCategory whereName($value)
 * @method static Builder|AddressCategory whereTagId($value)
 * @mixin Eloquent
 */
class AddressCategory extends Model
{
    protected $table = 'address_category';
    public $timestamps = false;

}
