<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerEmail extends Model
{
    use HasFactory;
    protected $table = 'customer_email';
    protected $fillable = ['result', 'error'];

    /**
     * @return BelongsTo
     */
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
