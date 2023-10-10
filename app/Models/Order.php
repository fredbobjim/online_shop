<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sum',
    ];

    public function skus()
    {
        return $this->belongsToMany(Sku::class)
            ->withPivot(['count', 'price'])
            ->withTimestamps();
    }

    public function getFullSum()
    {
        $sum = 0;
        foreach($this->skus as $sku){
            $sum += $sku->price * $sku->countInOrder;
        }
        return $sum;
    }

    public function saveOrder($name, $phone, $email)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->status = 1;
        $this->sum = $this->getFullSum();

        $skus = $this->skus;
        $this->save();
        foreach($skus as $skuInOrder){
            $this->skus()->attach($skuInOrder, [ 'count' => $skuInOrder->countInOrder, 'price' => $skuInOrder->price,]);

        }
        session()->forget('order');
        return true;
    }
}
