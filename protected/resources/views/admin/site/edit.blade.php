@extends('app')
@section('title')
    Edit Site<a class="pull-right" href="{{ url('site') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
@endsection
@section('main-content')
    {!! Form::model($site, ['method' => 'PATCH','url' => ['site', $site->id],'class' => 'form-horizontal']) !!}
    <div class="form-group">
        <label class="control-label col-md-4" for="bsc">BSC/RNC</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="bscrnc" id="bscrnc" placeholder="Search Min 1 Char (BSC, RNC, SITE ID)" value="{{$site->bscrnc}}">
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
            <input type="text" class="form-control" name="siteid" id="siteid" placeholder="Search Min 1 Char (SITE ID)" value="{{$site->siteid}}">
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
        <label for="inputSiteName" class="control-label col-md-4">Site Name</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="sitename" placeholder="Site Name" value="{{$site->sitename}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputLong" class="control-label col-md-4">Longitude</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="long" placeholder="Longitude" value="{{$site->longitude}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputLat" class="control-label col-md-4">Latitude</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="lat" placeholder="Latitude" value="{{$site->latitude}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputCellType" class="control-label col-md-4">Cell Type</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="celltype" placeholder="Cell Type" value="{{$site->celltype}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputMBC" class="control-label col-md-4">MBC</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="mbc" placeholder="MBC" value="{{$site->mbc}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputCol" class="control-label col-md-4">Collocated Site</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="coll" placeholder="Collocated Site" value="{{$site->collsite}}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
            <input  class="btn btn-primary" type="submit" value="Save" />
        </div>
    </div>
    {!! Form::close() !!}
@endsection