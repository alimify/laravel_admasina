@extends('layouts.admin.app')

@section('title','Book/Edit')

@push('css')

    <link href="{{asset('assets/admin/summernote/summernote-bs4.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/multiselect.css')}}" rel="stylesheet">
@endpush


@section('content')
    <div class="bg-white">
        <form method="post" action="{{route('admin.book.update',$book->id)}}" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="title"
                        value="{{$book->dTitle->first()->title??''}}">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="image" class="font-weight-bold">Image :</label>
                        <div class="d-block"><img src="{{asset('storage/book/'.$book->image)}}" width="80px"></div>
                        <input type="file" class="form-control-file" name="image" accept="image/x-png,image/gif,image/jpeg,image/png">
                    </div>


                    <div class="form-group col-sm-8 col-md-12">
                        <label for="ebook" class="font-weight-bold">Ebook File :</label>
                        <label for="selected-file" id="ebook_selected_file" class="font-weight-normal d-block">Selected File : </label>
                        <input type="file" class="form-control-file" name="ebook">
                    </div>

                    <div class="form-group col-sm-8 col-md-12">
                        <label for="title" class="font-weight-bold">Description :</label>
                        <textarea class="form-control" rows="5" name="description" id="summernote">{{$book->dDescription->first()->description??''}}</textarea>
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
                <a href="{{route('admin.book.index')}}" class="btn btn-primary btn-danger">BACK</a> <a class="btn btn-primary" href="javascript:void(0)" id="submit">EDIT</a>
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
                        langData[currentLangId].description = contents
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

///Manipulate Language Data
            var langData = <?php echo json_encode($langData) ?>,
                currentLangId = $("#language").val(),
                prevLangId = '',
                currentLangData = '',
                langEbook = <?php echo json_encode($langEbook); ?>,
                langIdList = {{json_encode($langIdList)}},
                langAbleEbook = <?php echo json_encode($langAbleEbook); ?>;
            returnCurrentLangData();


            $("#language").change(function () {
                returnCurrentLangData();
            });

            $("[name='title']").change(function () {
                langData[currentLangId].title = this.value.replace(/\s+/g,' ').trim()
            })


            $("[name='ebook']").change(function () {
                langEbook[currentLangId].file = [...this.files][0]
                $("#ebook_selected_file").text(`Selected File : ${langEbook[currentLangId].file.name}`)
            })


            $("#submit").click(function () {

                const defaultData = langData[{{Config::get('websettings.defaultLanguage')}}]
                var error = [];
                if(defaultData.title.length < 2){
                    error.push('Default language book title is required')
                }
                if(defaultData.description.length < 15){
                    error.push('Default language book description is required')
                }

                if(error.length > 0){
                    var html = '';
                    error.forEach(function (text) {
                        html+= errorText(text)
                    })
                    console.log(html)
                    $(html).insertBefore("div.animated")
                    return
                }

                var data = {
                        main: langData,
                        author: $("[name='author[]']").val(),
                        translator: $("[name='translator[]']").val(),
                        category:$("[name='category[]']").val(),
                        tag:$("[name='tag[]']").val(),
                        is_active:$("[name='active']").is(':checked')
                    },
                    form = new FormData(),
                    image = $("[name='image']").prop('files')[0]

                form.enctype = "multipart/form-data"
                form.append('data',JSON.stringify(data))
                form.append('image',image)
                form.append('_token',`{{csrf_token()}}`)
                form.append('_method','PUT')
                langIdList.forEach(function (item) {
                    form.append('ebook'+item,langEbook[item].file)
                })
                var ajax;
                try{ajax=new XMLHttpRequest()}catch(t){try{ajax=new ActiveXObject("Msxml2.XMLHTTP")}catch(t){try{ajax=new ActiveXObject("Microsoft.XMLHTTP")}catch(t){console.log("Something error....")}}}

                on('load',ajax,function (e) {
                    console.log(e.target.responseText)
                    const loads = JSON.parse(e.target.responseText)
                    if(loads.status){
                        window.open('{{route('admin.dashboard.ajaxSuccess',['route' => 'false','status' => 'Book Successfully Updated..'])}}',"_self")
                    }

                })

                ajax.open('POST',"{{route('admin.book.update',$book->id)}}");
                ajax.send(form);



            })





////functions....
            function _$(a, b = false){
                let returns = b ? document.querySelectorAll(a) : document.querySelector(a); returns == null ? console.log(a+'is null') : ``; return returns != null ? returns : document.querySelector("#this-is-for-default-selector");
            }
            function on(a, b, c){
                b.length ? b.forEach(e => {e.addEventListener(a, c)}) : b.addEventListener(a, c);return;
            }

            function returnCurrentLangData() {
                prevLangId = currentLangId
                langData[prevLangId].title = $("[name='title']").val().replace(/\s+/g,' ').trim()
                langData[prevLangId].description = $('#summernote').summernote('code')
                langEbook[prevLangId].file = $("[name='ebook']").prop('files')[0] ? $("[name='ebook']").prop('files')[0] : langEbook[prevLangId].file;

                currentLangId = $("#language").val()
                currentLangData = langData[currentLangId]
                $("[name='title']").val(currentLangData.title)
                $('#summernote').summernote('code',currentLangData.description)
                $("[name='ebook']").val('')
                const currentebookfile = `${langEbook[currentLangId].file.name == undefined && langAbleEbook[currentLangId].link.length > 2
                                           ? `<a href='/storage/${langAbleEbook[currentLangId].link}'>${langEbook[currentLangId].langTitle} Ebook File</a>`: langEbook[currentLangId].file.name }`;

                $("#ebook_selected_file").html(`Selected File : `+currentebookfile)
            }
            function errorText(text){
                return `<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="material-icons">close</i> </button> <span>${text}.</span> </div>`
            }

        });
    </script>

@endpush
