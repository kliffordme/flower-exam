<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product_table';


    protected $fillable = [
        'product_name',
        'product_description',
        'quantity',
        'prices',
        'status'
    ];

    public function order(){
        return $this->hasMany(Order::class);
    }
}
