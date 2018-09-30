@extends('layouts.admin.app')

@section('title','Book')

@push('css')


@endpush


@section('content')

    <a href="{{route('admin.book.changeStatus',$book->id)}}" class="btn btn-primary btn-warning">{{$book->is_active ? 'Draft' : 'Publish'}}</a>
    <a href="{{route('admin.book.edit',$book->id)}}" class="btn btn-primary btn-success">Edit</a>
    <a href="javascript:void(0)" class="btn btn-primary btn-danger delete-item">Delete</a>

    <br><br/>

    <div class="bg-white container-fluid">
        <h2>
       {{$book->dTitle->first()->title??''}}
        </h2>
        <div class="text-muted">
            <b>Status : </b> {{$book->is_active ? 'Published' : 'Draft'}} ,
            <b>By : </b> {{$book->user->name}} ,
            <b>Posted : </b> {{$book->created_at->diffForHumans()}}
        </div>

        <div class="border container-fluid">
            <div class="book-image row mb-3">
                <img class="img-thumbnail" src="{{asset('storage/book/'.$book->image)}}" alt="">
            </div>
            <div class="book-description row mb-3">
                <b>Description : </b>  {!!html_entity_decode($book->dDescription->first()->description??'')!!}

            </div>
            <div class="book-views row mb-3">
                <b>Views :</b> {{$book->views}}
            </div>
            <div class="book-rating row mb-3">
                <b>Rating :</b> {{$book->rating}}
            </div>
            <div class="book-author row mb-3">
                <b>Authors : </b> @foreach($book->authors as $author)
                                      {{$author->title}},
                                      @endforeach
            </div>
            <div class="book-translator row mb-3">
                <b>Translators : </b> @foreach($book->translators as $translator)
                                          {{$translator->title}},
                                          @endforeach
            </div>
            <div class="book-link row mb-3">
                <b>Book Links :</b> @foreach($book->dataLinks as $dataLink)
                                        <a href="{{asset('storage/'.$dataLink->link)}}" class="d-block">{{\App\Language::find($dataLink->pivot->language_id)->language}}</a>,
                                        @endforeach
            </div>
            <div class="book-category row mb-3">
                <b>Category : </b> @foreach($book->categories as $category)
                    <span class="">{{$category->title}} , </span>
                                       @endforeach
            </div>

            <div class="book-tag row mb-3">
                <b>Tags : </b> @foreach($book->tags as $tag)
                    <span class="">{{$tag->title}} , </span>
                                   @endforeach
            </div>
        </div>
    </div>
    <a href="{{route('admin.book.index')}}" class="btn btn-primary btn-danger mt-3 mb-2">Back</a>

@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.book.destroy',$book->id)}}`,
                deleteURL = currentURL,
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
