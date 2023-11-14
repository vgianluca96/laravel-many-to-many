@extends('admin.layouts.app')

@section('content')

<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center py-2">
        <div>
            <h1>
                All types
            </h1>
        </div>
        <div>
            <a href="{{route('admin.types.create')}}" class="btn btn-secondary">Add new type</a>
        </div>
    </div>

    @if(session('message'))
      <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
        <strong>Congratulations:</strong> {{session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="py-2">
      {{ $types->links('pagination::bootstrap-5') }}
    </div>

    <table class="table table-light table-striped">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <td>
                    {{$type->name}}
                </td>
                <td>
                    Lorem Ipsum
                </td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('admin.types.edit',$type->slug)}}" class="btn btn-light m-1">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                          </svg>
                        </a>
                        <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$type->id}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                            <path d="M2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z"/>
                          </svg>
                        </button>
                          
                          <div class="modal fade" id="deleteModal-{{$type->id}}" tabindex="-1" aria-labelledby="modalTitle-{{$type->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="modalTitle-{{$type->id}}">Delete <em>{{$type->name}}</em></h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Delete this type? This action <strong>cannot be undone</strong>.
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <form action="{{route('admin.types.destroy',$type->id)}}" method="POST" enctype="multipart/form-data">
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

        <div class="py-2">
            <h2>Da implementare:</h2>
            <ul>
                <li>
                    create.blade + CRUD create e store
                </li>
                <li>
                    edit.blade + CRUD edit e update
                </li>
                <li>
                    CRUD destroy (cosa succede se elimino un type già assegnato a uno o più progetti?)
                </li>
                <li>
                    CRUD show (serve visto che non ci sono dettagli da mostrare?? mostro tutti i progetti etichettati con quel tipo?)
                </li>
                <li>
                    eventuali regole di validation
                </li>
                <li>
                    Migration che aggiunga la colonna 'Description' alla table types
                </li>
            </ul>

        </div>
        
</div>

@endsection