<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use App\Models\PropertyOption;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PropertyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Property $property
     * @return View
     */
    public function index(Property $property): View
    {
        $propertyOptions = PropertyOption::paginate(10);
        return view('auth.property-options.index', compact('propertyOptions', 'property'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Property $property
     * @return View
     */
    public function create(Property $property): View
    {

        return view('auth.property-options.form', compact('property', ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @param Property $property
     * @return View
     */
    public function store(PropertyRequest $request, Property $property, ): View
    {

        $params = $request->all();
        $params['property_id'] = $request->property->id;
        PropertyOption::create($params);
        $propertyOptions = PropertyOption::paginate(10);

        return view('auth.property-options.index', compact('property', 'propertyOptions'));
    }

    /**
     * Display the specified resource.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return View
     */
    public function show(Property $property, PropertyOption $propertyOption): View
    {
        return view('auth.property-options.show', compact('propertyOption', 'property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return View
     */
    public function edit(Property $property, PropertyOption $propertyOption): View
    {
        return view('auth.property-options.form', compact('propertyOption', 'property'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param PropertyRequest $request
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return View
     */
    public function update( PropertyRequest $request, Property $property, PropertyOption $propertyOption, ): View
    {

        $params = $request->all();
        $propertyOption->update($params);
        $propertyOptions = PropertyOption::paginate(10);

        return view('auth.property-options.index', compact('propertyOption', 'property', 'propertyOptions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return RedirectResponse
     */
    public function destroy(Property $property, PropertyOption $propertyOption): RedirectResponse
    {
        $propertyOption->delete();
        return redirect()->route('property-options.index', compact('property'));
    }
}
