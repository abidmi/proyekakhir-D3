@extends('app')
@section('title')
    @if(Auth::user()->admin())
    <a href="{{ url('/antena/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Antena</a>
    @endif
    <a href="{{ url('/import/antena') }}" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Import Antena</a>
@endsection
@section('main-content')
    <div  class="table-responsive">
        <table class="table table-condensed table-hover table-bordered" id="table_antena">
            <thead>
            <tr>
                <th>#</th>
                <th>BSC/RNC</th>
                <th>SiteID</th>
                <th>Cell</th>
                <th>Ant. Mech Tilt</th>
                <th>Ant. Elec Tilt</th>
                <th>Ant. Tot</th>
                <th>Ant. Dir</th>
                <th>Ant. Height</th>
                <th>Ant. BW</th>
                <th>Ant. Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($antena as $value)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $value->bscrnc }}</td>
                    <td>{{ $value->siteid }}</td>
                    <td>{{ $value->cell }}</td>
                    <td>{{ $value->mech }}</td>
                    <td>{{ $value->elec }}</td>
                    <td>{{ $value->tot }}</td>
                    <td>{{ $value->dir }}</td>
                    <td>{{ $value->height }}</td>
                    <td>{{ $value->bw }}</td>
                    <td>{{ $value->type }}</td>
                    <td>
                        <a href="{{ url('antena/' . $value->id . '/edit') }}">
                            <button type="submit" class="btn btn-default btn-xs fa fa-edit"></button>
                        </a>
                        @if(Auth::user()->admin())
                        {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['antena', $value->id],
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
            $('#table_antena').DataTable();
        } );
    </script>
@endsection