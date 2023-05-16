<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    // RELATIONS
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    // MUTATORS
    protected function getCreatedAtAttribute($value)
    {
        return date('d/m/y h:i', strtotime($value));
    }

    protected function getUpdatedAtAttribute($value)
    {
        return date('d/m/y H:i', strtotime($value));
    }

    public function getAbstract($max = 50)
    {
        return substr($this->description, 0, $max) . "...";
    }

    // FILLABLE
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'is_visible',
        'photo',
    ];

    public function getImageUri()
    {
        return $this->photo ? asset('storage/' . $this->photo) : 'https://thumbs.dreamstime.com/b/no-image-available-icon-vector-illustration-flat-design-140476186.jpg';
    }
}
