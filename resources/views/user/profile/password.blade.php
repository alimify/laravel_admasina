@extends('layouts.user.app')

@section('title','Change Password')

@push('css')


@endpush


@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <form method="POST" action="{{route('user.password.update')}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="password">Old Password</label>
                                <input type="password" name="old_password" class="form-control" id="old_password" aria-describedby="old_passwordHelp" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="password" aria-describedby="passwordHelp" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control" id="password_confirmation" aria-describedby="rpHelp" autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('script')

@endpush
