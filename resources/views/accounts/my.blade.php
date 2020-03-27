@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1>Your Account</h1>
        <div class="accountWrapper">
            <h5><strong>Balance:</strong> {{ $account->balance }}</h5>
            
            <form method="post" action="{{ action('AccountController@increase') }}">
            @csrf
                <div class="form-group">
                    <label for="increase_balance">Mine bitcoins:</label>
                    <input name="increase_balance" type="number" class="form-control" id="increase_balance" placeholder="Enter number" style="width:200px">
                    <button type="submit" class="btn btn-primary">Increase</button>
                </div>
            </form>

            <form method="post" action="{{ action('AccountController@decrease') }}">
            @csrf
                <div class="form-group">
                    <label for="decrease_balance">Give to charity:</label>
                    <input name="decrease_balance" type="number" class="form-control" id="decrease_balance" placeholder="Enter number" style="width:200px">
                    <button type="submit" class="btn btn-primary">decrease</button>
                </div>
            </form>
        </div>
    </div>
@endsection
