@extends('admin.index')

@section('admin.content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <form method="post">
            @csrf
            <div class="form-group">
                <label for="user_name">Name:</label>
                <input name="name" type="text" class="form-control" id="user_name" placeholder="Name"
                       value="{{ old('name') ?: $user->name }}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                @isset($isUpdate)
                    <input hidden name="old_email" value="{{ $user->email }}">
                @endisset
                <label for="user_email">Email:</label>
                <input name="email" type="email" class="form-control" id="user_email" placeholder="Email"
                       value="{{ old('email') ?: $user->email }}">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            @isset($isUpdate)
                <div class="form-check">
                    <input hidden name="update_password" value="0">
                    <input class="form-check-input" type="checkbox" name="update_password" id="update_password"
                           value="1" {{ old('update_password') ? 'checked' : '' }}>
                    <label class="form-check-label" for="update_password">Update password</label>
                </div>
            @endisset
            <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password"
                       autocomplete="new-password">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirm Password:</label>
                <input name="password_confirmation" type="password" class="form-control" id="password-confirm"
                       placeholder="Confirm Password" autocomplete="new-password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


