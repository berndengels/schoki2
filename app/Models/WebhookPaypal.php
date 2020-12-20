<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookPaypal extends Model
{
    use HasFactory;
    protected $table = 'webhook_paypal';
    protected $fillable = ['mame','payload','exception'];

}
