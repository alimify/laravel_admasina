@extends('layouts.frontend.app')

@section('title','Search :'.$_REQUEST['q']??'')

@push('css')


@endpush


@section('content')

    <script>
        (function() {
            var cx = '006603814700875399181:fwsy989y9ag';
            var gcse = document.createElement('script');
            gcse.type = 'text/javascript';
            gcse.async = true;
            gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gcse, s);
        })();
    </script>
    <gcse:searchresults-only></gcse:searchresults-only>

@endsection


@push('script')

@endpush
