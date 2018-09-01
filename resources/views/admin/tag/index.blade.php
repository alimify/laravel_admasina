@extends('layouts.admin.app')

@section('title','Tag')

@push('css')
    <style>
        .table{
            background: #fff;
        }
    </style>

@endpush


@section('content')

    <a href="{{route('admin.tag.create')}}" class="btn btn-primary">Add New</a>
    <br><br/>

    @if($tags->count())

    <table class="table">

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
            @foreach($tags as $tag)
                <tr>
            <td><img src="{{asset('storage/tag/'.$tag->image)}}" width="70" alt=""></td>
            <td>{{$tag->title}}</td>
            <td>{{$tag->books->count()}}</td>
            <td>{{$tag->posts->count()}}</td>
            <td><a href="{{route('admin.tag.edit',$tag->id)}}"><i class="font-weight-bold cui-note"></i></a><a href="javascript:void(0)" class="delete-item" data-src="{{$tag->id}}"><i class="font-weight-bold cui-delete"></i></a> </td>
                </tr>
                @endforeach
        </tbody>

    </table>

    <div class="text-center">
        {{$tags->links()}}
    </div>
    @else
        <div class="bg-white text-center font-weight-bold"><br/>No Data available<br/><br></div>
    @endif

@endsection


@push('script')
<script>
    $(".delete-item").click(function () {

        let deleteForm = document.createElement('form'),
            currentURL = `{{route('admin.tag.destroy','deleteid')}}`,
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
