<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    public function dishes() {
        return $this->belongsToMany(Dish::class);
    }

    protected $fillable = ['restaurant_id',
    'customer_name',
    'customer_surname',
    'customer_mail',
    'customer_phone_number',
    'customer_address'];
}
