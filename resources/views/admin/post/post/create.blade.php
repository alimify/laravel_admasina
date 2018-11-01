@extends('layouts.admin.app')

@section('title','Post/Create')

@push('css')
    <link href="{{asset('assets/admin/css/multiselect.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/summernote/summernote-bs4.css')}}" rel="stylesheet">
@endpush


@section('content')
    <div class="bg-white">
        <form method="post" action="{{route('admin.post.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group text-center">
                <label for="title" class="font-weight-bold">Language</label>
                <select id="language" name="language">
                    @foreach($languages as $language)
                        <option value="{{$language->id}}"
                            {{Config::get('websettings.defaultLanguage') == $language->id ? 'selected' : ''}}
                        >{{$language->language}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Title :</label>
                        <input type="text" class="form-control" name="title">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="image" class="font-weight-bold">Image :</label>
                        <input type="file" class="form-control-file" name="image" accept="image/x-png,image/gif,image/jpeg,image/png">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Description :</label>
                        <textarea class="form-control" rows="5" name="description" id="summernote"></textarea>
                    </div>


                </div>


                <div class="col-sm-5 col-md-3">

                    <div class="form-group col-sm-8">
                        <label for="author" class="font-weight-bold d-block">Author :</label>
                        <select id="author" multiple="multiple" name="author[]">
                            @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-8">
                        <label for="translator" class="font-weight-bold d-block">Translator :</label>
                        <select id="translator" multiple="multiple" name="translator[]">
                            @foreach($translators as $translator)
                                <option value="{{$translator->id}}">{{$translator->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-8">
                        <label for="category" class="font-weight-bold d-block">Category :</label>
                        <select id="category" multiple="multiple" name="category[]">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-8">
                        <label for="tag" class="font-weight-bold d-block">Tag :</label>
                        <select id="tag" multiple="multiple" name="tag[]" class="form-control">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group col-sm-8">
                <input type="checkbox" name="active" value="1"> Publish
            </div>


            <div class="form-group col-sm-8">
                <a href="{{route('admin.post.index')}}" class="btn btn-primary btn-danger">BACK</a> <input class="btn btn-primary" type="submit" id="submit" value="ADD">
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
