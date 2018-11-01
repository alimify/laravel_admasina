@extends('layouts.admin.app')

@section('title','View Post')

@push('css')


@endpush


@section('content')

    <a href="{{route('admin.post.changeStatus',$post->id)}}" class="btn btn-primary btn-warning">{{$post->is_active ? 'Draft' : 'Publish'}}</a>
    <a href="{{route('admin.post.edit',$post->id)}}" class="btn btn-primary btn-success">Edit</a>
    <a href="javascript:void(0)" class="btn btn-primary btn-danger delete-item">Delete</a>

    <br><br/>

    <div class="bg-white container-fluid">
        <h2>
            {{$post->title}}
        </h2>
        <div class="text-muted">
            <b>Status : </b> {{$post->is_active ? 'Published' : 'Draft'}} ,
            <b>By : </b> {{$post->user->name}} ,
            <b>Posted : </b> {{$post->created_at->diffForHumans()}}
        </div>

        <div class="border container-fluid">
            <div class="post-image row mb-3">
                <img class="img-thumbnail" src="{{asset($post->image)}}" alt="">
            </div>
            <div class="post-description row mb-3">
                <b>Description : </b> {!!html_entity_decode($post->description)!!}
            </div>
            <div class="post-rating row mb-3">
                <b>Views :</b> {{$post->views}}
            </div>

            <div class="post-author row mb-3">
                <b>Author : </b> @foreach($post->authors as $author)
                    <span class="">{{$author->title}} , </span>
                @endforeach
            </div>

            <div class="post-translator row mb-3">
                <b>Translator : </b> @foreach($post->translators as $translator)
                    <span class="">{{$translator->title}} , </span>
                @endforeach
            </div>


            <div class="post-category row mb-3">
                <b>Category : </b> @foreach($post->categories as $category)
                    <span class="">{{$category->title}} , </span>
                @endforeach
            </div>

            <div class="post-tag row mb-3">
                <b>Tags : </b> @foreach($post->tags as $tag)
                    <span class="">{{$tag->title}} , </span>
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{route('admin.post.index')}}" class="btn btn-primary btn-danger mt-3 mb-2">Back</a>

@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.post.destroy',$post->id)}}`,
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
