<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Http\Requests\PropertyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $properties = Property::paginate(10);
        return view('auth.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.properties.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @return RedirectResponse
     */
    public function store(PropertyRequest $request): RedirectResponse
    {
        Property::create($request->all());
        return redirect()->route('properties.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Property $property
     * @return View
     */
    public function show(Property $property): View
    {
        return view('auth.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Property $property
     * @return View
     */
    public function edit(Property $property): View
    {
        return view('auth.properties.form', compact('property'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param PropertyRequest $request
     * @param Property $property
     * @return RedirectResponse
     */
    public function update(PropertyRequest $request, Property $property): RedirectResponse
    {
        $property->update($request->all());
        return redirect()->route('properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @return RedirectResponse
     */
    public function destroy(Property $property): RedirectResponse
    {
        $property->delete();
        return redirect()->route('properties.index');

    }
}
