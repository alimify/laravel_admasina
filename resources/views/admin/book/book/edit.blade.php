@extends('layouts.admin.app')

@section('title','Book/Edit')

@push('css')
    <link href="{{asset('assets/admin/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/summernote/summernote-bs4.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/multiselect.css')}}" rel="stylesheet">
    <style>
        .media-gallary-postion .modal{
            margin-left: 180px;}
    </style>

@endpush


@section('content')
    <div class="bg-white">
        <form method="post" action="{{route('admin.book.update',$book->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group text-center">
                <label for="title" class="font-weight-bold">Language</label>
                <select id="language" name="language">
                    @foreach($languages as $language)
                        <option value="{{$language->id}}"
                            {{$book->language_id == $language->id ? 'selected' : ''}}
                        >{{$language->language}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Title :</label>
                        <input type="text" class="form-control" name="title" value="{{$book->title}}">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="image" class="font-weight-bold">Image :</label>
                        <img src="{{asset($book->image)}}" width="100" class="d-block">
                        <input type="file" class="form-control-file" name="image" accept="image/x-png,image/gif,image/jpeg,image/png">
                    </div>

                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Description :</label>
                        <textarea class="form-control" rows="5" name="description" id="summernote">{{$book->description}}</textarea>
                    </div>



                    <div id="app" class="media-gallary-postion">
                        <media-modal v-if="showMediaManager" @media-modal-close="showMediaManager = false">
                            <media-manager
                                :is-modal="true"
                                :selected-event-name="selectedEventName"
                                @media-modal-close="showMediaManager = false"
                            >
                            </media-manager>
                        </media-modal>
                        <div class="form-group col-sm-8 col-md-12">
                            <label for="ebook" class="font-weight-bold d-block">Ebook File :</label>
                            <input type="button" name="ebook" class="btn btn-dark" @click="preventDefaults" value="Add File">
                            <textarea name="book_link" class="form-control" rows="1" id="book_link">{{$book->book_link}}</textarea>
                        </div>
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
                                <option value="{{$category->id}}"@if(in_array($category->id,$categoryIdArray)) selected @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-8">
                        <label for="tag" class="font-weight-bold d-block">Tag :</label>
                        <select id="tag" multiple="multiple" name="tag[]" class="form-control">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" @if(in_array($tag->id,$tagIdArray)) selected @endif>{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group col-sm-8">
                <input type="checkbox" name="active" value="1" @if($book->is_active) checked @endif> Publish
            </div>


            <div class="form-group col-sm-8">
                <a href="{{route('admin.book.index')}}" class="btn btn-primary btn-danger">BACK</a> <input type="submit" class="btn btn-primary" id="submit" value="EDIT">
            </div>
            <br>

        </form>
    </div>
@endsection


@push('script')
    <script src="{{asset('assets/admin/js/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/admin/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
                callbacks: {
                    onChange: function (contents,$editable) {
                    }
                }
            });

            $('#language').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })

            $('#category').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })

            $('#author').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })

            $('#translator').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })

            $('#tag').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
            })


            new Vue({
                el: '#app',
                data: {
                    showMediaManager: false,
                    selectedEventName: 'editor',
                },
                created: function(){
                    window.eventHub.$on('media-manager-notification', function (message, type, time) {
                        // Your custom notifiction call here...
                        console.log(message);
                    });
                },
                mounted(){
                    window.eventHub.$on('media-manager-selected-editor', (file) => {

                        const html = $("#book_link").val()+`<a href="{{route('index')}}${file.relativePath}" class="d-block">Download - ${file.name}</a><br/>`

                        // Do something with the file info...
                        //console.log(file.name);
                        //console.log(file.mimeType);
                         console.log(file.relativePath);
                        //console.log(file.webPath);

                        $("#book_link").val(html)

                        // Hide the Media Manager...
                        this.showMediaManager = false;

                    })
                },
                methods: {
                    preventDefaults (e){
                        e.preventDefault()
                        this.showMediaManager = true
                    }
                }
            });




        });
    </script>

@endpush
