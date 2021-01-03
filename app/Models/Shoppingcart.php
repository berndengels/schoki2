<?php
namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Shoppingcart
 *
 * @property int $identifier
 * @property string $instance
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Shoppingcart newModelQuery()
 * @method static Builder|Shoppingcart newQuery()
 * @method static Builder|Shoppingcart query()
 * @method static Builder|Shoppingcart whereContent($value)
 * @method static Builder|Shoppingcart whereCreatedAt($value)
 * @method static Builder|Shoppingcart whereIdentifier($value)
 * @method static Builder|Shoppingcart whereInstance($value)
 * @method static Builder|Shoppingcart whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Shoppingcart extends Model
{
    use HasFactory;

    protected $table = 'shoppingcart';
    protected $primaryKey = 'identifier';
}
