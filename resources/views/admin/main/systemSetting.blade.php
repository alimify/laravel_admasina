@extends('layouts.admin.app')

@section('title','Extra Settings.')

@push('css')


@endpush


@section('content')

    <div class="bg-white">
        <form method="post" action="{{route('admin.systemSetting.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')


            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Footer About US</label>
                <textarea name="footerAboutUs" class="form-control">{{Config::get('system.setting.footeraboutus')}}</textarea>
            </div>


            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Footer Useful Links</label>
                <textarea name="footerUsefulLinks" class="form-control">{{Config::get('system.setting.footerusefullinks')}}</textarea>
            </div>


            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Footer Social Links</label>
                <textarea name="footerSocialLinks" class="form-control">{{Config::get('system.setting.footersociallinks')}}</textarea>
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">About US</label>
                <textarea name="aboutUs" class="form-control">{{Config::get('system.setting.aboutus')}}</textarea>
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Privacy</label>
                <textarea name="privacy" class="form-control">{{Config::get('system.setting.privacy')}}</textarea>
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
