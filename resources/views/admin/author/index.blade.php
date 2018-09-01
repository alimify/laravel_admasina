@extends('layouts.admin.app')

@section('title','Author')

@push('css')

@endpush


@section('content')
    <a href="{{route('admin.author.create')}}" class="btn btn-primary">Add New</a>
    <br><br/>
    @if($authors->count())
        <table class="table bg-white">

            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Books</th>
                <th scope="col">Posts</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($authors as $author)
                <tr>
                    <th><img src="{{asset('storage/author/'.$author->image)}}" width="70" alt=""></th>
                    <th>{{$author->title}}</th>
                    <td>{{$author->books->count()}}</td>
                    <td>{{$author->posts->count()}}</td>
                    <td> <a href="{{route('admin.author.edit',$author->id)}}"><i class="font-weight-bold cui-note"></i></a><a href="javascript:void(0)" class="delete-item" data-src="{{$author->id}}"><i class="font-weight-bold cui-delete"></i></a></td>
                </tr>
            @endforeach
            </tbody>

        </table>

        <div class="text-center">
            {{$authors->links()}}
        </div>

    @else
        <div class="bg-white text-center font-weight-bold"><br/>No Data available<br/><br></div>

    @endif


@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.author.destroy','deleteid')}}`,
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
