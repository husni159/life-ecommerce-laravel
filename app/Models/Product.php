<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'images'
    ];
    protected $casts = [
        'images' => 'array',
    ];
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
    
    public function orders() {
        return $this->belongsToMany(Order::class, 'order_items');
    }
    
    // Decrement stock quantity for a product
    public function decrementStock(int $quantity)
    {
        $this->stock_quantity -= $quantity;
        $this->save();
    }
}
