@extends('app')
@section('title')
    Tambah Remark<a class="pull-right" href="{{ url('remark') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
@endsection
@section('main-content')
    {!! Form::open(['url' => 'remark', 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            <label class="control-label col-md-4" for="bsc">BSC/RNC</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="bscrnc" id="bscrnc" placeholder="Search Min 1 Char (BSC, RNC, SITE ID)">
            </div>
            <script>
                $(function()
                {
                    $( "#bscrnc" ).autocomplete({
                        source: "autocomplete/bsc",
                        minLength: 1,
                        select: function(event, ui) {
                            $('#bscrnc').val(ui.item.value);
                        }
                    });
                });
            </script>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="cell">CELL</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="cell" id="cell" placeholder="Search Min 1 Char (CELL, UTRANCELL)">
            </div>
            <script>
                $(function()
                {
                    $( "#cell" ).autocomplete({
                        source: "autocomplete/cell",
                        minLength: 1,
                        select: function(event, ui) {
                            $('#cell').val(ui.item.value);
                        }
                    });
                });
            </script>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="area">Area</label>
            <div class="col-md-4">
                <select class="form-control" name="area">
                    @foreach($CLUSTER_BICC_CJ as $value)
                        <option value="{{ $value->POC_NAME }}">{{ $value->POC_NAME }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputKPI" class="control-label col-md-4">KPI</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="kpi" placeholder="KPI">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="kategori">Kategori</label>
            <div class="col-md-4">
                <select class="form-control" name="kategori">
                    <option value="CAPACITY">CAPACITY</option>
                    <option value="CORE">CORE</option>
                    <option value="COVERAGE">COVERAGE</option>
                    {{--<option value="EXTERNAL INTERFERENCE">EXTERNAL INTERFERENCE</option>--}}
                    {{--<option value="FREQUENCY">FREQUENCY</option>--}}
                    <option value="HARDWARE/INSTALLATION/ALARM">HARDWARE/INSTALLATION/ALARM</option>
                    {{--<option value="IMPROPER RF PARAMETER">IMPROPER RF PARAMETER</option>--}}
                    {{--<option value="MISSING STATISTIC">MISSING STATISTIC</option>--}}
                    {{--<option value="NEIGHBOUR">NEIGHBOUR</option>--}}
                    <option value="TRANSMISSION">TRANSMISSION</option>
                    {{--<option value="UNDER INVESTIGATION">UNDER INVESTIGATION</option>--}}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="datex">Date Execution</label>
            <div class="col-md-4">
                <input type="text" id="datex" class="form-control" placeholder="yyyy-mm-dd" name="datex" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="datec">Date Close</label>
            <div class="col-md-4">
                <input type="text" id="datec" class="form-control" placeholder="yyyy-mm-dd" name="datec" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputRemark" class="control-label col-md-4">Remark</label>
            <div class="col-md-4">
                <textarea type="text" class="form-control" name="remark" placeholder="Remark"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="status">Status</label>
            <div class="col-md-4">
                <select class="form-control" name="status">
                    <option value="On Progress">On Progress</option>
                    <option value="Executed">Executed</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-4 col-md-4">
                <input  class="btn btn-primary" type="submit" value="Save" />
            </div>
        </div>
    {!! Form::close() !!}
    <script>
        $('#datex').datepicker({dateFormat: 'yy-mm-dd'});
        $('#datec').datepicker({dateFormat: 'yy-mm-dd'});
    </script>
@endsection