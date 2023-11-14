@extends('admin.layouts.app')

@section('content')

<div class="container py-4">

    <div class="py-2">
      <h1>Edit <em>{{$project->title}}</em> project</h1>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <form action="{{route('admin.projects.update',$project)}}" method="POST" enctype="multipart/form-data" class="row g-3">
    
        @csrf
        @method('PUT')
    
        <div class="col-md-6">
            <label for="projectTitle" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="projectTitle" name="title" placeholder="example title" value="{{old('title', $project->title)}}">
            @error('title')
              <div class="text-danger">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="col-md-6">
          <label for="projectType" class="form-label">Select a Type</label>
          <select class="form-control @error('type_id') is-invalid @enderror" name="type_id" id="projectType">
            <option value="" {{old('type_id', $project->type_id) == '' ? 'selected' : ''}}>No type</option>
            @foreach($types as $type)
            <option value="{{$type->id}}" {{old('type_id', $project->type_id) == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
            @endforeach
          </select>
          @error('type_id')
            <div class="text-danger">
              {{$message}}
            </div>
          @enderror
      </div>
    
        <div class="col-md-6">
            <label for="projectGithubLink" class="form-label">Github Link</label>
            <input type="text" class="form-control @error('github_link') is-invalid @enderror" id="projectGithubLink" name="github_link" placeholder="https://github.com/vgianluca96/folder-name" value="{{old('github_link', $project->github_link)}}">
            @error('github_link')
              <div class="text-danger">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="col-md-6">
          <label for="projectInternetLink" class="form-label">Internet Link</label>
          <input type="text" class="form-control @error('internet_link') is-invalid @enderror" id="projectInternetLink" name="internet_link" placeholder="https://project-domain.it" value="{{old('internet_link', $project->internet_link)}}">
          @error('internet_link')
            <div class="text-danger">
              {{$message}}
            </div>
          @enderror
      </div>
    
        <div class="col-md-12">
            <label for="projectDescription" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="projectDescription" name="description" placeholder="example description">{{old('description', $project->description)}}</textarea>
            @error('description')
              <div class="text-danger">
                {{$message}}
              </div>
            @enderror
        </div>
        
        <div class="col-12">
            <label for="projectPreview" class="form-label">Project preview</label>
            <input type="file" class="form-control @error('preview') is-invalid @enderror" id="projectPreview" name="preview">
            @error('preview')
              <div class="text-danger">
                {{$message}}
              </div>
            @enderror
        </div>

          <div class="col-12">
            <button type="submit" class="btn btn-dark">Update</button>
            <a href="{{route('admin.projects.index')}}" class="btn btn-light">Cancel</a>
          </div>

    </form>

</div>

@endsection