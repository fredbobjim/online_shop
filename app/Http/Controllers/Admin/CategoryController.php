<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::paginate(5);
        return view('auth.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $params = $request->all();
        if($request->has('image')){
            $params['image'] = $request->file('image')->store('categories');

        }
        Category::create($params);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        return view('auth.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('auth.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $params = $request->all();
        if($request->has('image')){
            Storage::delete($category->image);
            $path = $request->file('image')->store('categories');
            $params['image'] = $path;
        }
        $category->update($params);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
