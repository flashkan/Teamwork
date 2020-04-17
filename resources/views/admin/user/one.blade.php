@extends('admin.index')

@section('admin.content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <h5 class="card-title"><strong>Name:</strong> {{ $user->name }}</h5>
        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="card-text"><strong>Admin:</strong> {{ $user->is_admin }}</p>
        <p class="card-text"><strong>Created:</strong> {{ $user->created_at }}</p>
        <p class="card-text"><strong>Updated:</strong> {{ $user->updated_at }}</p>
        <a class="btn btn-success" href="{{ route('admin.user.update', $user) }}">Update</a>
        <a class="btn btn-danger" href="{{ route('admin.user.delete', $user) }}">Delete</a>
    </div>
@endsection
