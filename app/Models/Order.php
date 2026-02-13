<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = ['cart_id','user_id','customer_name','total_amount','order_date'];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
