<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';

    protected $guarded = [];

    //1 Category to has Many Order Purchase from Supplier
    public function ordersupply()
    {
       return $this->hasMany(OrderSupply::class);
    }

    public function product()
    {
       return $this->hasMany(Product::class);
    }

    //1 Category can be in many orders and many orders can have many categories
    public function categoryorders()
    {
        return $this->belongsToMany(CategoryOrder::class)->withPivot('category_id', 'order_id');
    }
}
