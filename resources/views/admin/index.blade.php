@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h3>Admin panel</h3>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('admin.user.all') }}"
               class="btn btn-primary {{ route('admin.user.all') === request()->url() ? 'btn-dark' : null }}">
                {{ __('All Users') }}</a>
            <a href="{{ route('admin.product.all') }}"
               class="btn btn-primary {{ route('admin.product.all') === request()->url() ? 'btn-dark' : null }}">
                {{ __('All Product') }}</a>
            <a href="{{ route('admin.lot.all') }}"
               class="btn btn-primary {{ route('admin.lot.all') === request()->url() ? 'btn-dark' : null }}">
                {{ __('All Lots') }}</a>
        </div>
    </div>
    @yield('admin.content')
@endsection
