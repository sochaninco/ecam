@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pop Up Banner</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('add_pop_up_banner')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Banner</a>
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
                            @foreach($popUps as $popUp)
                            <tr class="even gradeC">
                                <td><img src="{{asset('images/pop_up/'.$popUp->image)}}" class="img-responsive" style="width: 90px"></td>
                                <td>{{$popUp->url}}</td>
                                <td class="center">
                                    @if($popUp->status == 1)
                                        <a href="{{url('enable_pop_up/'.$popUp->id)}}" class="btn btn-success"><i class="fa fa-check"></i> </a>
                                    @else
                                        <a href="{{url('disable_pop_up/'.$popUp->id)}}" class="btn btn-warning"><i class="fa fa-times"></i> </a>
                                    @endif
                                    <a href="{{url('edit_pop_up_banner/'.$popUp->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                                    <a href="{{url('delete_pop_up_banner/'.$popUp->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this pop up?');"><i class="fa fa-times"></i>
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