<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$projects = Project::all();
        //$projects = DB::table('projects')->paginate(10);
        $projects = Project::orderByDesc('id')->paginate(10);

        return view('admin.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        $request->validated();

        $data = $request->all();
        $slug  = Str::slug($request->all()["title"], '-');
        $data += ['slug' => $slug];

        if ($request->has('preview')) {
            $file_path = Storage::put('projects_previews', $request->preview);
            $data['preview'] = $file_path;
        }

        $project = Project::create($data);
        $project->technologies()->attach($request->technologies);

        return to_route('admin.projects.index')->with('message', 'project successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->validated();

        $data = $request->all();
        $slug  = Str::slug($request->all()["title"], '-');
        $data += ['slug' => $slug];

        if ($request->has('preview')) {
            $file_path = Storage::put('projects_previews', $request->preview);
            $data['preview'] = $file_path;

            if ($project->preview) {
                Storage::delete($project->preview);
            }
        }

        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }

        return to_route('admin.projects.index')->with('message', 'project successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->preview) {
            Storage::delete($project->preview);
        }

        $project->technologies()->detach();

        $project->delete();

        return to_route('admin.projects.index')->with('message', 'project successfully deleted');
    }
}
