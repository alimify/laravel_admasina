@extends('layouts.admin.app')

@section('title','Comment/Edit')

@push('css')


@endpush


@section('content')


    <div class="bg-white">
        <form method="post" action="{{route('admin.comment.update',$comment->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Comment</label>
                <textarea class="form-control" rows="3" name="comment_text">{{$comment->comment_text}}</textarea>
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Commented By</label>
                <input type="text" class="form-control" name="user_name" value="{{$comment->user->name}}" readonly>
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Commented ON</label>
                <input type="text" class="form-control" name="comment_on"
                       value="@if($comment->book_id) Book @elseif($comment->post_id) Post @endif" readonly>
            </div>

            <div class="form-group col-sm-8">
                <a href="{{route('admin.comment.index')}}" class="btn btn-primary btn-danger">BACK</a> <input class="btn btn-primary" type="submit" value="EDIT">
            </div>
            <br>

        </form>
    </div>

@endsection


@push('script')

@endpush
