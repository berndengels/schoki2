<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\CustomerMail
 *
 * @property int $id
 * @property int $customer_id
 * @property int|null $result
 * @property string|null $error
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Customer $customer
 * @method static Builder|CustomerMail newModelQuery()
 * @method static Builder|CustomerMail newQuery()
 * @method static Builder|CustomerMail query()
 * @method static Builder|CustomerMail whereCreatedAt($value)
 * @method static Builder|CustomerMail whereCustomerId($value)
 * @method static Builder|CustomerMail whereError($value)
 * @method static Builder|CustomerMail whereId($value)
 * @method static Builder|CustomerMail whereResult($value)
 * @method static Builder|CustomerMail whereUpdatedAt($value)
 * @mixin Eloquent
 */
class CustomerMail extends Model
{
    use HasFactory;
    protected $table = 'customer_mail';
    protected $fillable = ['customer_id', 'result', 'error'];

    /**
     * @return BelongsTo
     */
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
