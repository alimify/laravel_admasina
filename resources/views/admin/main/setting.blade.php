@extends('layouts.admin.app')

@section('title','Settings')

@push('css')


@endpush


@section('content')

    <div class="bg-white">
        <form method="post" action="{{route('admin.websetting.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')


            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Site Title</label>
                <input type="text" class="form-control" name="siteTitle" value="{{Config::get('websettings.siteTitle')}}">
            </div>


            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Homepage Title</label>
                <input type="text" class="form-control" name="homePageTitle" value="{{Config::get('websettings.homePageTitle')}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Default Language</label>
                <select name="defaultLanguage" class="form-control">
                    @foreach($languages as $language)
                        <option value="{{$language->id}}"
                        {{Config::get('websettings.defaultLanguage') == $language->id ? 'selected' : ''}}>{{$language->language}}</option>
                        @endforeach
                </select>
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Site Article Per Page</label>
                <input type="number" class="form-control" name="siteArticlePerPage" value="{{Config::get('websettings.siteArticlePerPage')}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Site Book Per Page</label>
                <input type="number" class="form-control" name="siteBookPerPage" value="{{Config::get('websettings.siteBookPerPage')}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Site Comment Per Page</label>
                <input type="number" class="form-control" name="siteCommentPerPage" value="{{Config::get('websettings.siteCommentPerPage')}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Admin Item Per Page</label>
                <input type="number" class="form-control" name="adminItemPerPage" value="{{Config::get('websettings.adminItemPerPage')}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="image" class="font-weight-bold">Site Logo</label>
                <img src="{{asset('storage/laraption/'.Config::get('websettings.siteLogo'))}}" class="img-thumbnail img-responsive d-block">
                <input type="file" class="form-control-file" name="image">
            </div>

            <div class="form-group col-sm-8">
                <a href="{{route('admin.websetting.index')}}" class="btn btn-primary btn-danger">BACK</a> <input class="btn btn-primary" type="submit" value="EDIT">
            </div>
            <br>

        </form>
    </div>

@endsection


@push('script')

@endpush
