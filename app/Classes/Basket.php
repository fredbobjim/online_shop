<?php
namespace App\Classes;

use App\Models\Order;
use App\Models\Sku;
use Illuminate\Support\Facades\Auth;

class Basket
{
    protected $order;

    public function __construct($createOrder = false)
    {
        $order = session('order');
        session(['order' => $order]);

        if (is_null($order) && $createOrder ) {
            $data = [];
            if(Auth::check()){
                $data['user_id'] = Auth::id();
            }
            $this->order = new Order($data);
            session(['order' => $this->order]);
        } else {
            $this->order = $order;
        }
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function countAvailable()
    {
        foreach($this->order->skus as $orderSku){
            if($orderSku->countInOrder > $orderSku->count){
                return false;
            }
        }
        return true;
    }

    public function addSku(Sku $sku)
    {
        if ($this->order->skus->contains($sku)){
            $pivotRow = $this->order->skus->where('id', $sku->id)->first();
            if ($pivotRow->countInOrder >= $sku->count){
                return false;
            }
            $pivotRow->countInOrder++;
        } else {
            if($sku->count == 0) {
                return false;
            }
            $sku->countInOrder = 1;
            $this->order->skus->push($sku);
        }
        return true;
    }

    public function removeSku(Sku $sku, $request)
    {
        if ($this->order->skus->contains($sku)){
            $pivotRow = $this->order->skus->where('id', $sku->id)->first();
            if ($request->input('delete') == 'Y') {
                $collection = $this->order->skus;
                foreach ($collection as $key => $item) {
                    if ($item->id == $sku->id) {
                        $collection->pull($key);
                    }
                }
            } elseif ($pivotRow->countInOrder > 1) {
                $pivotRow->countInOrder--;
            }
        }
    }

    public function saveOrder($name, $phone, $email)
    {
        if (!$this->countAvailable()){
            return false;
        }
        $this->order->saveOrder($name, $phone, $email);
        return true;
    }
}
