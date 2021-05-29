@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Promotion</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-12">
            <a href="{{url('admin_add_promotion')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>Add promotion </a>
        </div>
        <br>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your promotion
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> ID</th>
                                <th> Name </th>
                                <th> Value</th>
                                <th> Started Date </th>
                                <th> Finished Date</th>
                                <th> Image</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($promotions as $promotion)
                            <tr class="even gradeC">
                                <td>{{$promotion->id}}</td>
                                <td>{{$promotion->name}}</td>
                                <td>{{$promotion->value }} @if($promotion->value_type == 0) % @else $ @endif</td>
                                <td>{{$promotion->started_date}}</td>
                                <td>{{$promotion->finished_date}}</td>
                                <td><img src="{{asset('images/'.$promotion->image)}}"></td>
                                <td class="center">
                                    <a href="{{url('edit_promotion/'.$promotion->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{url('delete_promotion/'.$promotion->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i>
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