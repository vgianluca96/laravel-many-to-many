@extends('admin.layouts.app')

@section('content')

<div class="container py-4">

    <div class="py-2">
      <h1>Create a new project type</h1>
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

    <form action="{{route('admin.types.store')}}" method="POST" enctype="multipart/form-data" class="row g-3">
    
        @csrf
    
        <div class="col-md-6">
            <label for="typeName" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="typeName" name="name" placeholder="example name" value="{{old('name')}}">
            @error('name')
              <div class="text-danger">
                {{$message}}
              </div>
            @enderror
        </div>

        
          <div class="col-12">
            <button type="submit" class="btn btn-dark">Create</button>
            <a href="{{route('admin.types.index')}}" class="btn btn-light">Cancel</a>
          </div>

    </form>

</div>


@endsection