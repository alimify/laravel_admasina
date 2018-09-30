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
                            {{Config::get('websettings.defaultLanguage') == $language->id ? 'selected' : ''}}
                        >{{$language->language}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Title :</label>
                        <input type="text" class="form-control" name="title" value="{{$post->dTitle->first()->title??''}}">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="image" class="font-weight-bold">Image :</label>
                        <img src="{{asset('storage/post/'.$post->image)}}" alt="" class="img-thumbnail d-block" width="80px">
                        <input type="file" class="form-control-file" name="image" accept="image/x-png,image/gif,image/jpeg,image/png">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Description :</label>
                        <textarea class="form-control" rows="5" name="description" id="summernote">{{$post->dDescription->first()->description??''}}</textarea>
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
                <a href="{{route('admin.post.index')}}" class="btn btn-primary btn-danger">BACK</a> <a class="btn btn-primary" href="javascript:void(0)" id="submit">EDIT</a>
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
                        langData[cLang].description = contents
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

            var langData = <?php echo json_encode($langData); ?>,
                pLang,
                cLang = $("#language").val();

            $("[name='title']").change(function () {
                langData[cLang].title = this.value
            })

            $("#language").change(function(){
                pLang = cLang
                cLang = this.value

                langData[pLang].title = $("[name='title']").val()
                langData[pLang].description = $('#summernote').summernote('code')

                $("[name='title']").val(langData[cLang].title)
                $('#summernote').summernote('code',langData[cLang].description)
            })


            $("#submit").click(function () {
                var dtLang = langData[{{Config::get('websettings.defaultLanguage')}}],
                    errorF = false;

                if(dtLang.title.length < 20){
                    errorF = !errorF
                    $(errorText('Default language title should be greater than 20 letters.')).insertBefore("div.animated")
                }

                if(dtLang.description.length < 30){
                    if(!errorF){
                        errorF = true
                    }
                    $(errorText('Default language description should be greater than 30 letters.')).insertBefore("div.animated")
                }

                if(!errorF) {
                    var data = {
                            langData: langData,
                            category: $("#category").val(),
                            author: $("#author").val(),
                            translator: $("#translator").val(),
                            tag: $("#tag").val(),
                            active: $("[name='active']").prop('checked')
                        },
                        image = $("[name='image']").prop('files')[0],
                        form = new FormData(),
                        ajax;

                    form.append('data', JSON.stringify(data))

                    if (image != undefined) {
                        form.append('image', image)
                    }
                    form.append('_token', `{{csrf_token()}}`)
                    form.append('_method', 'PUT')
                    try {
                        ajax = new XMLHttpRequest()
                    } catch (t) {
                        try {
                            ajax = new ActiveXObject("Msxml2.XMLHTTP")
                        } catch (t) {
                            try {
                                ajax = new ActiveXObject("Microsoft.XMLHTTP")
                            } catch (t) {
                                console.log("Something error....")
                            }
                        }
                    }
                    on('load', ajax, function (e) {
                        console.log(e.target.responseText)
                        const loads = JSON.parse(e.target.responseText)
                        if (loads.status) {
                            window.open('{{route('admin.dashboard.ajaxSuccess',['route' => 'false','status' => 'Post Successfully Edited.'])}}', "_self")
                        }else{
                            errorText('Post Can not added , something error.')
                        }
                    })

                    ajax.open('POST', "{{route('admin.post.update',$post->id)}}");
                    ajax.send(form);
                }
            })


            function _$(a, b = false){
                let returns = b ? document.querySelectorAll(a) : document.querySelector(a); returns == null ? console.log(a+'is null') : ``; return returns != null ? returns : document.querySelector("#this-is-for-default-selector");
            }
            function on(a, b, c){
                b.length ? b.forEach(e => {e.addEventListener(a, c)}) : b.addEventListener(a, c);return;
            }

            function errorText(text){
                return `<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="material-icons">close</i> </button> <span>${text}.</span> </div>`
            }

        });
    </script>

@endpush
