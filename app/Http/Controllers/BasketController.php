<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Classes\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }

    public function order()
    {
        $basket = new Basket();
        $order = ($basket)->getOrder();
        if(!$basket->countAvailable()){
            session()->flash('warning', __('basket.not_available_in_full'));
            return redirect()->route('basket');
        }
        return view("order", compact('order'));
    }

    public function orderConfirm(Request $request)
    {
        $basket = new Basket();

        $email = Auth::check() ? Auth::user()->email : $request->email;

        if($basket->saveOrder($request->name, $request->phone, $email)){
            session()->flash('success', __('basket.your_order_confirmed'));
        } else {
            session()->flash('warning', __('basket.not_available_in_full'));
        }
        return redirect()->route('index');
    }

    public function basketAdd(Sku $sku)
    {
        $result = (new Basket(true))->addSku($sku);

        if(!$result) session()->flash('warning', __('basket.not_available_in_full'));

        return redirect()->route('basket');
    }

    public function basketRemove(Sku $sku, Request $request)
    {
        (new Basket())->removeSku($sku, $request);

        return redirect()->route('basket');
    }
}
