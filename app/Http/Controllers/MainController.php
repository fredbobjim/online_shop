<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sku;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller{
    public function index(Request $request){
        $skusQuery = Sku::with('product', 'product.category');
        if ($request->filled('price_from')){
            $skusQuery->where('price', '>=', $request->price_from);
        }if ($request->filled('price_to')){
            $skusQuery->where('price', '<=', $request->price_to);
        }
        if ($request->filled('word')){

            $skusQuery->whereHas('product', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->word.'%');
            })->get();
        }
        foreach(['hit', 'new', 'recommended'] as $field){
            if ($request->has($field)){
                $skusQuery->whereHas('product', function (Builder $query) use ($field) {
                    $query->where($field,'=',1);
                })->get();
            }
        }
        $skus = $skusQuery->paginate(6)->withQueryString();
        return view("index", compact('skus'));
    }

    public function categories()
    {
        $categories = Category::get();
        return view("categories", compact('categories'));
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
        $skus = Sku::with('product')
            ->whereHas( 'product', function(Builder $query) use ($category) {
                return $query->where('category_id', '=', $category->id);
            })
            ->paginate(6);
        return view('category', compact('category', 'skus'));
    }

    public function sku($categoryCode, $productCode, Sku $sku)
    {
        if ($sku->product->code != $productCode){
            abort(404, 'Product not found');
        }

        if ($sku->product->category->code != $categoryCode){
            abort(404, 'Category not found');
        }

        return view("product", compact( 'sku'));
    }

    public function changeLocale($locale)
    {
        $availableLocales = ['ru', 'en',];
        if(!in_array($locale, $availableLocales)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
}
