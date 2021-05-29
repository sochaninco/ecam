@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category Slide</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('add_category_slide')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Slide</a>
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
                                <th> Category Name</th>
                                <th> Image Promotion Type</th>
                                <th> Image Name </th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $arraySlideType = ['1'=>'Vertical','2'=>'Horizontal','3'=>'Header Vertical','4'=>'Header Top Horizontal','5'=>'Advertise Left','6'=>'Footer Image','7'=>'Product Banner','8'=>'Brand Zone Banner','9'=>'Brand Zone Banner Haft','10'=>'Banner Beauty','11'=>'Best Seller','12'=>'Horizontal Shop Page','13'=>'Feature Banner','14'=>'Horizontal Top Mobile','15'=>'Advertise Right','17'=>'Horizontal After Top Mobile','18'=>'ECamMall Category Banner'];
                            ?>
                            @foreach($CategorySlide as $slide)
                            <tr class="even gradeC">
                                <td>{{$slide->name}}</td>
                                <td>{{$arraySlideType[$slide->slide_type]}}</td>
                                <td><img src="{{asset('images/home/'.$slide->image)}}" class="img-responsive" style="width: 90px"></td>
                                {{--<td>{{$category->cost}}</td>--}}
                                <td class="center">
                                    @if($slide->status == 1)
                                        <a href="{{url('enable_slide_category/'.$slide->id)}}" class="btn btn-success"><i class="fa fa-check"></i> </a>
                                    @else
                                        <a href="{{url('disable_slide_category/'.$slide->id)}}" class="btn btn-warning"><i class="fa fa-times"></i> </a>
                                    @endif
                                    <a href="{{url('edit_slide_category/'.$slide->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                                    <a href="{{url('delete_slide_category/'.$slide->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this slide?');"><i class="fa fa-trash"></i>
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