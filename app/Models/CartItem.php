<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'cart_item_id';
    public $timestamps = false;

    protected $fillable = ['cart_id','product_id','quantity','price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
