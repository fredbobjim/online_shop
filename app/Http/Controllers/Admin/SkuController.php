<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return View
     */
    public function index(Product $product): View
    {
        $skus = $product->skus()->paginate(10);
        return view('auth.skus.index', compact('skus', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     * @return View
     */
    public function create(Product $product): View
    {
        return view('auth.skus.form', compact('product'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SkuRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(SkuRequest $request, Product $product): RedirectResponse
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $sku = Sku::create($params);
        $sku->propertyOptions()->sync($request->property_id);
        return redirect()->route('skus.index', compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @param Sku $sku
     * @return View
     */
    public function show(Product $product, Sku $sku): View
    {
        return view('auth.skus.show', compact('product', 'sku'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @param Sku $sku
     * @return View
     */
    public function edit(Product $product, Sku $sku): View
    {
        return view('auth.skus.form', compact('product', 'sku'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param SkuRequest $request
     * @param Product $product
     * @param Sku $sku
     * @return RedirectResponse
     */
    public function update(SkuRequest $request, Product $product, Sku $sku): RedirectResponse
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $sku->update($params);
        $sku->propertyOptions()->sync($request->property_id);
        return redirect()->route('skus.index', compact('product','sku',));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @param Sku $sku
     * @return RedirectResponse
     */
    public function destroy(Product $product, Sku $sku): RedirectResponse
    {
        $sku->delete();
        return redirect()->route('skus.index', compact('product'));

    }
}
