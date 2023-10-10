<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {

        $products = Product::paginate(5);
        return view('auth.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {

        $categories = Category::get();
        $properties = Property::get();

        return view('auth.products.form', compact('categories', 'properties'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $params = $request->all();
        if($request->has('image')){
            $params['image'] = $request->file('image')->store('products');

        }
        Product::create($params);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
        $product = Product::find($id);
        $categories = Category::get();
        return view('auth.products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        $product = Product::find($id);
        $categories = Category::get();
        $properties = Property::get();
        return view('auth.products.form', compact('product', 'categories', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, $id): RedirectResponse
    {
        $product = Product::find($id);
        $params = $request->all();
        unset($params['image']);
        if($request->has('image')){
            Storage::delete($product->image);
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
        }
        foreach(['new', 'hit', 'recommended'] as $fieldName){
            if(!isset($params[$fieldName])){
                $params[$fieldName] = 0;
            }
        }

        $product->update($params);
        $product->properties()->sync($request->property_id);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
