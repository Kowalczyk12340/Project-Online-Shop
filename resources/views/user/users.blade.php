@extends('admin.welcome')
@section('content')
    <section class="container-fluid mt-5 dashboard d-flex justify-content-center">
        <div class="row m-0 p-0">
            <div class="col-12">
            <h2 class="font-weight-bold mb-3">{{__('translation.users.index.users')}}</h2>
                <a class="btn btn-success text-white" href={{route('user.create')}}>{{__('translation.users.create.addUser')}}</a>
                <table class="table table-striped mt-5 text-center table-hover table-responsive"> 
                    <thead class="bg-dark text-white ">
                    <tr>
                        <th>{{__('translation.users.index.id')}}</th>
                        <th>{{__('translation.users.index.img')}}</th>
                        <th>{{__('translation.users.index.userName')}}</th>
                        <th>{{__('translation.users.index.userSurname')}}</th>
                        <th>{{__('translation.users.index.userEmail')}}</th>
                        <th>{{__('translation.users.index.created_at')}}</th>
                        <th>{{__('translation.users.index.updated_at')}}</th>
                        <th>{{__('translation.users.index.details')}}</th>
                        <th>{{__('translation.users.index.edit')}}</th>
                        <th>{{__('translation.users.index.delete')}}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td><img class="img-fluid" src="{{$user->photo}}" style="width:50px; height:50px;"></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td><a class="btn btn-info text-white" href="{{route('user.show', ['user' => $user])}}">{{'Szczegóły'}}</a></td>
                            @if($user->deleted_at == null)
                            <td>
                                <a class="btn btn-warning text-white" href="{{route('user.edit', ['user' => $user])}}">{{__('translation.users.index.edit')}}</a>
                            </td>
                            <td>
                                <form method="post" action="{{route('user.delete', ['user' => $user])}}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger text-white" type="submit">{{__('translation.users.index.delete')}}</button>
                                </form>
                            </td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    </section>
@endsection
