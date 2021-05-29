@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Theme Shop</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('add_theme_shop')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Theme</a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    All theme listing
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> No </th>
                                <th> Theme Type</th>
                                <th>Banner Theme</th>
                                <th>Banner Small</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($themes as $theme)
                            <tr class="even gradeC">
                                <td>{{$theme->id}}</td>
                                <td>{{$theme->shop_type}}</td>
                                <td>
                                    <img src="{{asset('images/theme-shop/'.$theme->theme_banner)}}" class="img-responsive" width="80px">
                                </td>
                                <td>
                                    <img src="{{asset('images/theme-shop/'.$theme->theme_banner_small)}}" class="img-responsive" width="80px">
                                </td>
                                <td class="center">
                                    <a href="{{url('edit_theme_shop/'.$theme->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{url('delete_theme_shop/'.$theme->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this banner theme?');"><i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
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