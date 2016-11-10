@extends('app')
@section('title')
    Import Remark<a class="pull-right" href="{{ url('remark') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
@endsection
@section('main-content')
                        @if (Session::has('message'))
                            <div class="col-md-12">
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{ Session::get('message') }}
                                </div>
                            </div>
                        @endif
                        {!! Form::open(array('url' => 'upload/remark', 'files' => true)) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('file', 'File Excel') !!}
                                    {!! Form::file('file', Input::old('file'), array('class' => 'form-control')) !!}
                                </div>
                                {!! Form::submit('Import Excel', array('class' => 'btn btn-primary')) !!}
                                {!! Form::close() !!}
                            </div>

                            <div class="col-md-8">
                                <a href="{{ url('/dlfile/remark') }}" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Download Format File Remark</a>
                            </div>
                        </div>
@endsection