@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banner Link Mobile</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('add_banner_link_mobile')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Banner</a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your banner
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Image Name </th>
                                <th> URL </th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($banner)
                            <tr class="even gradeC">
                                <td><img src="{{asset('images/home/'.$banner->image)}}" class="img-responsive" style="width: 90px"></td>
                                <td>{{$banner->url}}</td>
                                <td class="center">
                                    <a href="{{url('edit_banner_link_mobile/'.$banner->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                                    <a href="{{url('delete_slide_category/'.$banner->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this banner?');"><i class="fa fa-times"></i>
                                    </a>
                                    {{--<button type="button" class="btn btn-danger"><i class="fa fa-times"></i>--}}
                                    {{--</button>--}}
                                </td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
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