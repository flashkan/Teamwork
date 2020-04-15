@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h3>Admin panel</h3>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('admin.users') }}"
               class="btn btn-primary {{ route('admin.users') === request()->url() ? 'btn-dark' : null }}">
                {{ __('All Users') }}</a>
            <a href="{{ route('admin.products') }}"
               class="btn btn-primary {{ route('admin.products') === request()->url() ? 'btn-dark' : null }}">
                {{ __('All Product') }}</a>
            <a href="{{ route('admin.lots') }}"
               class="btn btn-primary {{ route('admin.lots') === request()->url() ? 'btn-dark' : null }}">
                {{ __('All Lots') }}</a>
        </div>
    </div>
    @yield('admin.content')
@endsection
