@extends('app')
@section('title')
    <a href="{{ url('/export-comsite') }}" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Export Complete Site</a>
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
                <th>Collocated Site</th>
                <th>Ant Mech</th>
                <th>Ant Ele</th>
                <th>Ant Tot</th>
                <th>Ant Dir</th>
                <th>Ant Height</th>
                <th>Ant BW</th>
                <th>Ant Type</th>
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
                    <td>{{ $value->mech }}</td>
                    <td>{{ $value->elec }}</td>
                    <td>{{ $value->tot }}</td>
                    <td>{{ $value->dir }}</td>
                    <td>{{ $value->height }}</td>
                    <td>{{ $value->bw }}</td>
                    <td>{{ $value->type }}</td>
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