<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table='customers';

    //1 customer can have many orders 
    public function ordersupply()
    {
       return $this->hasMany(Order::class);
    }
}
