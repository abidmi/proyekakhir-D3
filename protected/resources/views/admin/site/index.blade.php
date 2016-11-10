@extends('app')
@section('title')
    @if(Auth::user()->admin())
    <a href="{{ url('/site/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Site</a>
    @endif
    <a href="{{ url('/import/site') }}" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Import Site</a>
@endsection
@section('main-content')
    <div  class="table-responsive">
        <table class="table table-condensed table-hover table-bordered" id="table_site">
            <thead>
            <tr>
                <th>#</th>
                <th>BSC/RNC</th>
                <th>SiteID</th>
                <th>Site Name</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Cell Type</th>
                <th>MBC</th>
                <th>Collocated Ste</th>
                <th>Action</th>
            </tr>
            </thead>
            {{-- */$x=0;/* --}}
            @foreach($site as $value)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $value->bscrnc }}</td>
                    <td>{{ $value->siteid }}</td>
                    <td>{{ $value->sitename }}</td>
                    <td>{{ $value->longitude }}</td>
                    <td>{{ $value->latitude }}</td>
                    <td>{{ $value->celltype }}</td>
                    <td>{{ $value->mbc }}</td>
                    <td>{{ $value->collsite }}</td>
                    <td>
                        <a href="{{ url('site/' . $value->id . '/edit') }}">
                            <button type="submit" class="btn btn-default btn-xs fa fa-edit"></button>
                        </a>
                        @if(Auth::user()->admin())
                        {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['site', $value->id],
                        'style' => 'display:inline'
                        ]) !!}
                        <button type="submit" class="btn btn-default btn-xs fa fa-trash"></button>
                        {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            <tbody>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready( function () {
            $('#table_site').DataTable();
        } );
    </script>
@endsection