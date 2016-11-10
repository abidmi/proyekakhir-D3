@extends('app')
@section('title')
    Tambah Antena<a class="pull-right" href="{{ url('antena') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
@endsection
@section('main-content')
    {!! Form::open(['url' => 'antena', 'class' => 'form-horizontal']) !!}
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
        <label class="control-label col-md-4" for="siteid">SiteID</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="siteid" id="siteid" placeholder="Search Min 1 Char (SITE ID)">
        </div>
        <script>
            $(function()
            {
                $( "#siteid" ).autocomplete({
                    source: "autocomplete/site",
                    minLength: 1,
                    select: function(event, ui) {
                        $('#siteid').val(ui.item.value);
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
        <label for="inputMech" class="control-label col-md-4">Ant. Mech Tilt</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="mech" placeholder="Ant. Mech Tilt">
        </div>
    </div>
    <div class="form-group">
        <label for="inputElec" class="control-label col-md-4">Ant. Elec Tilt</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="elec" placeholder="Ant. Elec Tilt">
        </div>
    </div>
    <div class="form-group">
        <label for="inputTot" class="control-label col-md-4">Ant. Tot Tilt</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="tot" placeholder="Ant. Tot Tilt">
        </div>
    </div>
    <div class="form-group">
        <label for="inputDir" class="control-label col-md-4">Ant. Dir</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="dir" placeholder="Ant. Dir">
        </div>
    </div>
    <div class="form-group">
        <label for="inputHeight" class="control-label col-md-4">Ant. Height</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="height" placeholder="Ant. Height">
        </div>
    </div>
    <div class="form-group">
        <label for="inputBW" class="control-label col-md-4">Ant. BW</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="bw" placeholder="Ant. BW">
        </div>
    </div>
    <div class="form-group">
        <label for="inputType" class="control-label col-md-4">Ant. Type</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="type" placeholder="Ant. Type">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
            <input  class="btn btn-primary" type="submit" value="Save" />
        </div>
    </div>
    {!! Form::close() !!}
@endsection