<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shoppingcart extends Model
{
    use HasFactory;

    protected $table = 'shoppingcart';
    protected $primaryKey = 'identifier';
}
