@extends('layouts.admin.app')

@section('title','Book')

@push('css')


@endpush


@section('content')
    <a href="{{route('admin.book.create')}}" class="btn btn-primary">Add New</a>
    <br><br/>
    @if($books->count())
    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Translator</th>
            <th scope="col">Published</th>
            <th scope="col">Views</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
        <tr>
            <th>
                <img src="{{asset($book->image)}}" width="80px" alt="">
            </th>
            <td>
                {{str_limit($book->title??'',40)}}
            </td>
            <td>
                @foreach($book->authors as $author)
                    {{$author->title}},
                    @endforeach
            </td>

            <td>
                @foreach($book->translators as $translator)
                    {{$translator->title}},
                @endforeach
            </td>

            <td>
                <i class="{{$book->is_active ? 'text-success fa fa-check' : 'text-danger fa fa-remove'}}"></i>

            </td>
            <td>
                {{$book->views}}
            </td>
            <td>{{$book->created_at}}</td>
            <td><a href="{{route('admin.book.show',$book->id)}}"><i style="font-size: 20px" class="font-weight-bold fa fa-eye"></i> </a> <a href="{{route('admin.book.edit',$book->id)}}"><i class="font-weight-bold cui-note"></i></a> <a href="javascript:void(0)" class="delete-item" data-src="{{$book->id}}"><i class="font-weight-bold cui-delete"></i></a> </td>
        </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{$books->links()}}
    </div>

    @else
        <div class="bg-white text-center font-weight-bold"><br/>No Data available<br/><br></div>

    @endif
@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.book.destroy','deleteid')}}`,
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
