<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = ['user_id','assigned_staff_id','status','subtotal','tax','total'];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function staff() {
        return $this->belongsTo(User::class,'assigned_staff_id');
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

}