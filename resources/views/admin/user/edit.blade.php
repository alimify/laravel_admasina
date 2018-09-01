@extends('layouts.admin.app')

@section('title',$user->name)

@push('css')


@endpush


@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <form method="POST" action="{{route('admin.user.update',$user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                                <label for="email">Password</label>
                                <input type="text" name="password" class="form-control" id="password"  autocomplete="off" placeholder="Leave empty to keep current password">
                            </div>

                            <div class="form-group">
                                <label for="quote">Quote</label>
                                <textarea name="quote" class="form-control" id="quote">{{$user->quote}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" id="role">
                               <option value="1" {{$user->role_id == 1 ? 'selected' : ''}}>Admin</option>
                                <option value="2" {{$user->role_id == 2 ? 'selected' : ''}}>Member</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <img src="{{asset('storage/'.$user->image)}}" width="120px" alt="" class="d-block">
                                <input name="image" type="file" class="form-control form-control-file" id="image" aria-describedby="imageHelp">
                            </div>

                            <a href="{{route('admin.user.index')}}" class="btn btn-primary btn-danger">BACK</a> <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('script')

@endpush
