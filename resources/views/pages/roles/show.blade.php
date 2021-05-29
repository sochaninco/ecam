@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Show Role</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
        <div class="col-lg-12">
            {{--<a href="{{url('add_footer_page')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Footer Page</a>--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your Role
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="col-lg-9">
                        <div class="form-group">
                            {!! Form::label('display_name','Display Name',['class'=>' col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! $role->display_name !!}
                                <p></p>
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('email')) has-error @endif">
                            {!! Form::label('description','Description',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! $role->description !!}
                                <p></p>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('permission','Permission',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <label class="label label-success">{{ $v->display_name }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection