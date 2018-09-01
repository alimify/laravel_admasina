@extends('layouts.admin.app')

@section('title','Comment')

@push('css')
    <style>
        .table{
            background: #fff;
        }
    </style>

@endpush


@section('content')

@if($comments->count())
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Comment</th>
            <th scope="col">Commented By</th>
            <th scope="col">Commented On</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
        <tr>
            <td>{{str_limit($comment->comment_text,20)}}..</td>
            <td>{{$comment->user->name}}</td>
            <td>
              @if($comment->book_id)
                Book
                  @elseif($comment->post_id)
                Post
                @endif
            </td>
            <td><a href="{{route('admin.comment.edit',$comment->id)}}"><i class="font-weight-bold cui-note"></i></a><a href="javascript:void(0)" class="delete-item" data-src="{{$comment->id}}"><i class="font-weight-bold cui-delete"></i></a> </td>
        </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{$comments->links()}}
    </div>

    @else

    <div class="bg-white text-center font-weight-bold"><br/>No Data available<br/><br></div>

    @endif

@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.comment.destroy','deleteid')}}`,
                deleteURL = currentURL.replace('deleteid',this.dataset.src),
                csrfInput = document.createElement('input'),
                methodInput = document.createElement('input')
            deleteForm.style.display = 'none';
            deleteForm.method = 'POST'
            deleteForm.action = deleteURL
            csrfInput.name = `_token`
            csrfInput.value = `{{csrf_token()}}`
            methodInput.name = `_method`
            methodInput.value = `DELETE`
            deleteForm.appendChild(csrfInput)
            deleteForm.appendChild(methodInput)
            document.body.appendChild(deleteForm)
            deleteForm.submit()
        })
    </script>
@endpush
