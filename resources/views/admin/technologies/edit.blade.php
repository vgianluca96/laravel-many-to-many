@extends('admin.layouts.app')

@section('content')

<div class="container py-4">

    <div class="py-2">
      <h1>update {{$technology->name}}</h1>
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

    <form action="{{route('admin.technologies.update',$technology->id)}}" method="POST" enctype="multipart/form-data" class="row g-3">
    
        @csrf
        @method('PUT')
    
        <div class="col-md-6">
            <label for="technologyName" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="technologyName" name="name" placeholder="example name" value="{{old('name',$technology->name)}}">
            @error('name')
              <div class="text-danger">
                {{$message}}
              </div>
            @enderror
        </div>

        
          <div class="col-12">
            <button type="submit" class="btn btn-dark">Update</button>
            <a href="{{route('admin.technologies.index')}}" class="btn btn-light">Cancel</a>
          </div>

    </form>

</div>


@endsection