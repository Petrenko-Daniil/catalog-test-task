<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = ['total_price', 'status'];
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['amount']);
    }
    public function updateTotalPrice(): static{
        $products = $this->products;
        $totalPrice = 0;
        foreach ($products as $product){
           $totalPrice += $product->price * $product->pivot->amount;
        }
        $this->update([
            'total_price' => $totalPrice
        ]);
        return $this;
    }
}
