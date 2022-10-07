<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Model;

// class Supplier extends Model
class Supplier extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guard = 'suppliers';

    protected $table='suppliers';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //1 supplier can receiver an order request from admin for products in multiple categories
    public function ordersupply()
    {
       return $this->hasMany(OrderSupply::class);
    }

    //1 Supplier can have many products and many products can belong to 1 supplier
    public function products()
    {
        return $this->belongsToMany(ProductSupplier::class)->withPivot('product_id', 'supplier_id');
    }
}
