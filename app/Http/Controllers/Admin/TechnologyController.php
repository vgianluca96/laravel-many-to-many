<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::paginate(5);

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate(
            [
                'name' => 'required|unique:technologies,name'
            ]
        );

        $data['slug'] = Str::slug($request->name, '-');

        Technology::create($data);

        return to_route('admin.technologies.index')->with('message', 'technology successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->validate(
            [
                'name' => ['required', Rule::unique('technologies')->ignore($technology)]
            ]
        );

        $data['slug'] = Str::slug($request->name, '-');

        $technology->update($data);

        return to_route('admin.technologies.index')->with('message', 'technology successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->projects()->detach();

        $technology->delete();

        return to_route('admin.technologies.index')->with('message', 'technology successfully deleted!');
    }
}
