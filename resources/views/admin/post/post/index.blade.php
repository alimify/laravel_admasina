@extends('layouts.admin.app')

@section('title','Post')

@push('css')
    <style>
        .table{
            background: #fff;
        }
    </style>

@endpush


@section('content')
    <a href="{{route('admin.post.create')}}" class="btn btn-primary">Add New</a>
    <br><br/>

    @if($posts->count())
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <!--<th scope="col">Posted By</th>-->
            <th scope="col">Authors</th>
            <th scope="col">Translators</th>
            <th scope="col">Published</th>
            <th>Views</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
        <tr>
            <th><img src="{{asset('storage/post/'.$post->image)}}" alt="" width="80px"></th>
            <td>
                    {{$post->dTitle->first()->title??''}}
            </td>
            <!--<td>{{$post->user->name}}</td>-->
            <td>
                @foreach($post->authors as $author)
                    {{$author->title}},
                    @endforeach
            </td>
            <td>
                @foreach($post->translators as $translator)
                    {{$translator->title}},
                    @endforeach
            </td>
            <td> <i class="{{$post->is_active ? 'text-success fa fa-check' : 'text-danger fa fa-remove'}}"></i></td>
            <td>{{$post->views}}</td>
            <td>{{$post->created_at}}</td>
            <td><a href="{{route('admin.post.show',$post->id)}}"><i style="font-size: 20px" class="font-weight-bold fa fa-eye"></i> </a> <a href="{{route('admin.post.edit',$post->id)}}"><i class="font-weight-bold cui-note"></i></a> <a href="javascript:void(0)" class="delete-item" data-src="{{$post->id}}"><i class="font-weight-bold cui-delete"></i></a> </td>
        </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{$posts->links()}}
    </div>
        @else
        <div class="bg-white text-center font-weight-bold"><br/>No Data available<br/><br></div>
    @endif
@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.post.destroy','deleteid')}}`,
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
