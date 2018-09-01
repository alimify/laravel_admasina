@extends('layouts.admin.app')

@section('title','User')

@push('css')


@endpush


@section('content')

    <a href="{{route('admin.user.create')}}" class="btn btn-primary">Add New</a>
    <br><br/>
    @if($users->count())
    <table class="table bg-white">
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td><img src="{{asset('storage/'.$user->image)}}" alt="" width="60px" class="img-circle img-avatar"> </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->title}}</td>
            <td>{{$user->is_active ? 'Active' : 'Deactive'}}</td>
            <td><a href="{{route('user.profile.show',$user->id)}}"><i style="font-size: 20px" class="font-weight-bold fa fa-eye"></i> </a><a href="{{route('admin.user.edit',$user->id)}}"><i class="font-weight-bold cui-note"></i></a><a href="javascript:void(0)" class="delete-item" data-src="{{$user->id}}"><i class="font-weight-bold cui-delete"></i></a> </td>
        </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{$users->links()}}
    </div>

@else
        <div class="bg-white text-center font-weight-bold"><br/>No Data available<br/><br></div>
    @endif
@endsection


@push('script')
    <script>
        $(".delete-item").click(function () {

            let deleteForm = document.createElement('form'),
                currentURL = `{{route('admin.user.destroy','deleteid')}}`,
                deleteURL = currentURL.replace('deleteid',this.dataset.src),
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
