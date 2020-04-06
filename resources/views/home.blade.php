@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Home page</h3>
        <ajax-template-component :url="'{{ route('ajax') }}'"></ajax-template-component>
    </div>
@endsection
