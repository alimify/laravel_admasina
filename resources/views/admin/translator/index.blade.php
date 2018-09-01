@extends('layouts.admin.app')

@section('title','Translator')

@push('css')
    <style>
        .table{
            background: #fff;
        }
    </style>

@endpush


@section('content')
    <a href="{{route('admin.translator.create')}}" class="btn btn-primary">Add New</a>
    <br><br/>
    @if($translators->count())
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
        @foreach($translators as $translator)
        <tr>
            <td><img src="{{asset('storage/translator/'.$translator->image)}}" width="70" alt=""></td>
            <td>{{$translator->title}}</td>
            <td>{{$translator->books->count()}}</td>
            <td>{{$translator->posts->count()}}</td>
            <td><a href="{{route('admin.translator.edit',$translator->id)}}"><i class="font-weight-bold cui-note"></i></a><a href="javascript:void(0)" class="delete-item" data-src="{{$translator->id}}"><i class="font-weight-bold cui-delete"></i></a> </td>
        </tr>
            @endforeach
        </tbody>

    </table>

    <div class="text-center">
        {{$translators->links()}}
    </div>

    @else
        <div class="bg-white text-center font-weight-bold"><br/>No Data available<br/><br></div>

    @endif

@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.translator.destroy','deleteid')}}`,
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
