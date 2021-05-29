@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category Listing</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your category and subcategory
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Category Code</th>
                                <th> Category Name </th>
                                <th> Category Image </th>
                                {{--<th> Product Cost</th>--}}
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr class="even gradeC">
                                <td>{{$category->code}}</td>
                                <td>{{$category->name}}</td>
                                <td><img src="{{asset('images/'.$category->image)}}" class="img-responsive" style="width: 90px"></td>
                                {{--<td>{{$category->cost}}</td>--}}
                                <td class="center">
                                    <a href="{{url('edit_category/'.$category->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
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