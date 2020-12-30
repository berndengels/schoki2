<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
