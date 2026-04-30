<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'stock', 'image', 'is_active'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function cartItems() {
        return $this->hasMany(Cart::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function getImageUrlAttribute() {
        return $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png');
    }
}