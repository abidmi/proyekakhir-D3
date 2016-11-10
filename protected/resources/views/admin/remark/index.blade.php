@extends('app')
@section('title')
    @if(Auth::user()->admin())
    <a href="{{ url('/remark/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Remark</a>
    @endif
    <a href="{{ url('/import/remark') }}" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Import Remark</a><br><br>
    <form action="{{ url('/download-remark') }}" method="get">
        <div class="col-md-2">
            <input type="text" id="from" class="form-control" placeholder="Dari Tanggal" name="from" value="">
        </div>
        <div class="col-md-2">
            <input type="text" id="to" class="form-control" placeholder="Sampai Tanggal" name="to" value="">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Download Report Remark Data</button>
    </form>
@endsection
@section('main-content')
    <div  class="table-responsive">
        <table class="table table-condensed table-hover table-bordered" id="table_remark">
            <thead>
            <tr>
                <th>#</th>
                <th>BSC/RNC</th>
                <th>CELL</th>
                <th>AREA</th>
                <th>KPI</th>
                <th>KATEGORI</th>
                <th>DATE EXECUTION</th>
                <th>DATE CLOSE</th>
                <th>REMARK</th>
                <th>STATUS</th>
                <th>CREATED BY</th>
                <th>UPDATED BY</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($remark as $value)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $value->bscrnc }}</td>
                    <td>{{ $value->cell }}</td>
                    <td>{{ $value->area }}</td>
                    <td>{{ $value->kpi }}</td>
                    <td>{{ $value->kategori }}</td>
                    <td>{{ $value->date_ex }}</td>
                    <td>{{ $value->date_close }}</td>
                    <td>{{ $value->remark }}</td>
                    <td>{{ $value->status }}</td>
                    <td>{{ $value->created_by }}</td>
                    <td>{{ $value->update_by }}</td>
                    <td>
                        <a href="{{ url('remark/' . $value->id . '/edit') }}">
                            <button type="submit" class="btn btn-default btn-xs fa fa-edit"></button>
                        </a>
                        @if(Auth::user()->admin())
                        {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['remark', $value->id],
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
            $('#table_remark').DataTable();
        } );
    </script>
    <script>
        $('#from').datepicker({dateFormat: 'yy-mm-dd'});
        $('#to').datepicker({dateFormat: 'yy-mm-dd'});
    </script>
@endsection