@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Footer Type</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('add_footer_type')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Footer Type</a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your Footer
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> No</th>
                                <th> Name </th>
                                {{--<th> Product Cost</th>--}}
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($FooterType as $type)
                            <tr class="even gradeC">
                                <td>{{$type->id}}</td>
                                <td>{{$type->name}}</td>
                                {{--<td>{{$category->cost}}</td>--}}
                                <td class="center">
                                    <a href="{{url('edit_footer_type/'.$type->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{url('delete_footer_type/'.$type->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this footer type?');"><i class="fa fa-times"></i>
                                    </a>
                                    {{--<button type="button" class="btn btn-danger"><i class="fa fa-times"></i>--}}
                                    {{--</button>--}}
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