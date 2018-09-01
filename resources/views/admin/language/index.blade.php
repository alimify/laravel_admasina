@extends('layouts.admin.app')

@section('title','Language')

@push('css')
    <style>
        .table{
            background: #fff;
        }
    </style>

@endpush


@section('content')
    <a href="{{route('admin.language.create')}}" class="btn btn-primary">Add New</a>
    <br><br/>

    @if($languages->count())

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Flag</th>
            <th scope="col">Country</th>
            <th scope="col">Language</th>
            <th scope="col">Short-Code</th>
            <th scope="col">Books</th>
            <th scope="col">Posts</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($languages as $language)
        <tr>
            <td><img src="{{asset('storage/language/'.$language->image)}}" alt="" width="32"></td>
            <td>{{$language->country}}</td>
            <td>{{$language->language}}</td>
            <td>{{$language->short_code}}</td>
            <td>{{$language->books->count()}}</td>
            <td>{{$language->posts->count()}}</td>
            <td><a href="{{route('admin.language.edit',$language->id)}}"><i class="font-weight-bold cui-note"></i></a><a href="javascript:void(0)" class="delete-item" data-src="{{$language->id}}"><i class="font-weight-bold cui-delete"></i></a> </td>
        </tr>
            @endforeach
        </tbody>

    </table>

    <div class="text-center">
        {{$languages->links()}}
    </div>

    @else
        <div class="bg-white text-center font-weight-bold"><br/>No Data available<br/><br></div>
    @endif

@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.language.destroy','deleteid')}}`,
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
