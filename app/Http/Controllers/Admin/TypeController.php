<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::paginate(4);

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate(
            [
                'name' => 'required|unique:types,name'
            ]
        );

        $data['slug'] = Str::slug($data['name'], '-');

        Type::create($data);

        return to_route('admin.types.index')->with('message', 'type successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->validate(
            [
                'name' => ['required', Rule::unique('types')->ignore($type)]
            ]
        );

        $data['slug'] = Str::slug($data['name'], '-');

        $type->update($data);

        return to_route('admin.types.index')->with('message', 'type successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {

        //Project::where('type_id', $type->id)->update(array('type_id' => null));
        $type->projects()->where('type_id', $type->id)->update(array('type_id' => null));
        $type->delete();

        return to_route('admin.types.index')->with('message', 'type successfully deleted!');
    }
}
