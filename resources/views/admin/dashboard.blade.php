@extends('admin.layouts.app')

@section('content')

<div class="container py-4">
    <h1>
        Hi, {{$admin_user->name}}
    </h1>
</div>

@endsection
