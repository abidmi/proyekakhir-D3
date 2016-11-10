@extends('app')
@section('title')
    <a href="{{ url('/user/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah User</a>
@endsection
@section('main-content')
    <div  class="table-responsive">
        <table class="table table-condensed table-hover table-bordered" id="table_user">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Passowrd</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($user as $value)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->username }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->password }}</td>
                    <td>{{ $value->role }}</td>
                    <td>
                        <a href="{{ url('user/' . $value->id . '/edit') }}">
                            <button type="submit" class="btn btn-default btn-xs fa fa-edit"></button>
                        </a>
                        @if(Auth::user()->admin())
                            {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['user', $value->id],
                            'style' => 'display:inline'
                            ]) !!}
                            <button type="submit" class="btn btn-default btn-xs fa fa-trash"></button>
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready( function () {
            $('#table_user').DataTable();
        } );
    </script>
@endsection