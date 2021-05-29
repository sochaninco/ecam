@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Subcategory Listing</li>
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
                    List all your subcategories
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Category Name</th>
                                <th> Subcategory Code</th>
                                <th> Subcategory Name </th>
                                <th> Subcategory Image </th>
                                <th> Logo</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subcategories as $subcategory)
                            <tr class="even gradeC">
                                <td>{{$categories[$subcategory->parent_id]}}</td>
                                <td>{{$subcategory->code}}</td>
                                <td>{{$subcategory->name}}</td>
                                <td><img src="http://ecammall.com/stock/assets/uploads/{{$subcategory->image}}" class="img-responsive" style="width: 90px"></td>
                                <td><img src="{{asset('images/category/sub-small/'.$subcategory->logo)}}" class="img-responsive"></td>
                                <td class="center">
                                    <a href="{{url('edit_subcategory/'.$subcategory->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
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