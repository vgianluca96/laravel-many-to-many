@extends('admin.layouts.app')

@section('content')

<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center py-2">
        <div>
            <h1>
                All Projects
            </h1>
        </div>
        <div>
            <a href="{{route('admin.projects.create')}}" class="btn btn-secondary">Add new project</a>
        </div>
    </div>

    @if(session('message'))
      <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
        <strong>Congratulations:</strong> {{session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="py-2">
      {{ $projects->links('pagination::bootstrap-5') }}
    </div>

    <table class="table table-light table-striped">
        <thead>
          <tr>
            <th scope="col">Preview</th>
            <th scope="col">Title</th>
            <th scope="col">Github</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>
                    @if($project->preview)
                        @if(str_contains($project->preview,'http'))
                        <img src="{{$project->preview}}" alt="" width="100">
                        @else
                        <img src="{{asset('storage/' . $project->preview)}}" alt="" width="100">
                        @endif
                    @endif
                </td>
                <td>
                    {{$project->title}}
                </td>
                <td>
                  <a href="{{$project->github_link}}" target="_blank">
                    {{$project->github_link}}
                  </a>
                </td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('admin.projects.show',$project->slug)}}" class="btn btn-dark m-1">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                          </svg>
                        </a>
                        <a href="{{route('admin.projects.edit',$project->slug)}}" class="btn btn-light m-1">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                          </svg>
                        </a>
                        <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$project->id}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                            <path d="M2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z"/>
                          </svg>
                        </button>
                          
                          <div class="modal fade" id="deleteModal-{{$project->id}}" tabindex="-1" aria-labelledby="modalTitle-{{$project->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="modalTitle-{{$project->id}}">Delete <em>{{$project->title}}</em></h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Delete this project? This action <strong>cannot be undone</strong>.
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <form action="{{route('admin.projects.destroy',$project->id)}}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
</div>

@endsection