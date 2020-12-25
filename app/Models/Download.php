<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\Download
 *
 * @property string $token
 * @property string $route
 * @property int $customer_id
 * @property string|null $valid_until
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Customer $customer
 * @method static Builder|Download newModelQuery()
 * @method static Builder|Download newQuery()
 * @method static Builder|Download query()
 * @method static Builder|Download whereCreatedAt($value)
 * @method static Builder|Download whereCustomerId($value)
 * @method static Builder|Download whereRoute($value)
 * @method static Builder|Download whereToken($value)
 * @method static Builder|Download whereUpdatedAt($value)
 * @method static Builder|Download whereValidUntil($value)
 * @mixin Eloquent
 */
class Download extends Model
{
    use HasFactory;

    protected $table        = 'download';
    protected $primaryKey   = 'token';
    protected $fillable     = ['token','route','valid_until'];

    /**
     * @return BelongsTo
     */
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
