<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function dishes() {
        return $this->hasMany(Dish::class);
    }

    public function types() {
        return $this->belongsToMany(Type::class);
    }

    protected $fillable = ["id", "user_id", "name", "address", "vat_number", "phone_number", "description", "photo"];

    public function getImageUri()
    {
        return $this->photo ? url('storage/' . $this->photo) : 'https://thumbs.dreamstime.com/b/no-image-available-icon-vector-illustration-flat-design-140476186.jpg';
    }
}