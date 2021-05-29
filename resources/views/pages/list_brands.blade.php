@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Brands Listing</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            {{--<a href="{{url('add_brands')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Brands</a>--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    All brand listing
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Code </th>
                                <th> Name</th>
                                <th> Category</th>
                                <th>Image</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                            <tr class="even gradeC">
                                <td>{{$brand->code}}</td>
                                <td>{{$brand->name}}</td>
                                <td>
                                    @if($brand->category_id > 0)
                                        {{ $category[$brand->category_id]}}
                                    @endif
                                </td>
                                <td><img src="http://ecammall.com/stock/assets/uploads/{{$brand->image}}" class="img-responsive" width="50px"></td>
                                <td class="center">
                                    <a href="{{url('edit_brands/'.$brand->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                    </a>
                                    {{--@if($brand->status == 0)
                                        <a href="{{url('delete_brands/'.$brand->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this brand?');"><i class="fa fa-times"></i>
                                        </a>
                                    @else
                                        <a href="{{url('enable_brands/'.$brand->id)}}" class="btn btn-info" onclick="return confirm('Are you sure you want to enable this brand?');"><i class="fa fa-check"></i>
                                        </a>
                                    @endif--}}
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