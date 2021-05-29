@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Slide Show Listing</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('add_slide')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Slide</a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your slide
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Product Code</th>
                                <th> Image Name </th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slides as $slide)
                            <tr class="even gradeC">
                                <td>
                                    @if(!empty($slide->product_id))
                                        {{$product[$slide->product_id]}}
                                    @endif
                                </td>
                                <td><img src="{{asset('images/home/'.$slide->image)}}" class="img-responsive" style="width: 90px"></td>
                                {{--<td>{{$category->cost}}</td>--}}
                                <td class="center">
                                    @if($slide->status == 1)
                                        <a href="{{url('enable_slide/'.$slide->id)}}" class="btn btn-success"><i class="fa fa-check"></i> </a>
                                    @else
                                        <a href="{{url('disable_slide/'.$slide->id)}}" class="btn btn-warning"><i class="fa fa-times"></i> </a>
                                    @endif
                                    <a href="{{url('edit_slide/'.$slide->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                                    <a href="{{url('delete_slide/'.$slide->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this slide?');"><i class="fa fa-trash"></i>
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