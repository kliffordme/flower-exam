<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order_table';


    protected $fillable = [
        'product_id',
        'user_id',
        'price',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
