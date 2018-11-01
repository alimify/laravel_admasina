@extends('layouts.admin.app')

@section('title','Post/Edit')

@push('css')
    <link href="{{asset('assets/admin/css/multiselect.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/summernote/summernote-bs4.css')}}" rel="stylesheet">
@endpush


@section('content')
    <div class="bg-white">
        <form method="post" action="{{route('admin.post.update',$post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group text-center">
                <label for="title" class="font-weight-bold">Language</label>
                <select id="language" name="language">
                    @foreach($languages as $language)
                        <option value="{{$language->id}}"
                            {{$post->languag_id == $language->id ? 'selected' : ''}}
                        >{{$language->language}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Title :</label>
                        <input type="text" class="form-control" name="title" value="{{$post->title}}">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="image" class="font-weight-bold">Image :</label>
                        <img src="{{asset($post->image)}}" alt="" class="img-thumbnail d-block" width="80px">
                        <input type="file" class="form-control-file" name="image" accept="image/x-png,image/gif,image/jpeg,image/png">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Description :</label>
                        <textarea class="form-control" rows="5" name="description" id="summernote">{{$post->description}}</textarea>
                    </div>


                </div>


                <div class="col-sm-5 col-md-3">

                    <div class="form-group col-sm-8">
                        <label for="author" class="font-weight-bold d-block">Author :</label>
                        <select id="author" multiple="multiple" name="author[]">
                            @foreach($authors as $author)
                                <option value="{{$author->id}}" @if(in_array($author->id,$authorIdArray)) selected @endif>{{$author->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-8">
                        <label for="translator" class="font-weight-bold d-block">Translator :</label>
                        <select id="translator" multiple="multiple" name="translator[]">
                            @foreach($translators as $translator)
                                <option value="{{$translator->id}}" @if(in_array($translator->id,$translatorIdArray)) selected @endif>{{$translator->title}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-sm-8">
                        <label for="category" class="font-weight-bold d-block">Category :</label>
                        <select id="category" multiple="multiple" name="category[]">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{in_array($category->id,$categoryIdArray) ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-8">
                        <label for="tag" class="font-weight-bold d-block">Tag :</label>
                        <select id="tag" multiple="multiple" name="tag[]" class="form-control">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" {{in_array($tag->id,$tagIdArray) ? 'selected' : ''}}>{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group col-sm-8">
                <input type="checkbox" name="active" value="1" {{$post->is_active ? 'checked' : ''}}> Publish
            </div>


            <div class="form-group col-sm-8">
                <a href="{{route('admin.post.index')}}" class="btn btn-primary btn-danger">BACK</a> <input type="submit" class="btn btn-primary" id="submit" value="EDIT">
            </div>
            <br>

        </form>
    </div>
@endsection


@push('script')
    <script src="{{asset('assets/admin/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/multiselect.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
                callbacks: {
                    onChange: function (contents,$editable) {

                    }
                }
            })

            $('#author').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })

            $('#translator').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })

            $('#language').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })


            $('#category').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })

            $('#tag').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })


        });
    </script>

@endpush
