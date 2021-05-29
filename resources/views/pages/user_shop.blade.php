@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users Shop</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            {{--<a href="{{url('add_footer_page')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Footer Page</a>--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all Product from User : {{$ShopName}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="col-sm-3 pull-right" style="margin-bottom: 20px">
                        <a href="{{url('admin/user_shop/'.$ShopInfo->user_id.'/admin_add_product')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Product</a>
                    </div>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Image</th>
                                <th> Product Code </th>
                                <th> Product Name</th>
                                {{--<th> Product Cost</th>--}}
                                <th> Product Price</th>
                                <th> Quantity </th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Products as $product)
                                <tr class="even gradeC">
                                    <?php
                                    $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                    ?>
                                    <td><img src="{{asset('images/thumbnails/'.$imageName)}}" class="img-responsive" width="50px"></td>
                                    <td>{{$product->code}}</td>
                                    <td>{{substr($product->name,0,20)}}...</td>
                                    {{--<td>{{$product->cost}}</td>--}}
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td class="center">
                                        <a href="{{url('admin/shop/edit_product/'.$product->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                        </a>
                                        @if($product->status == 0)
                                            <a href="{{url('admin/shop/disable_product/'.$product->id)}}" class="btn btn-danger"><i class="fa fa-times"></i>
                                            </a>
                                        @else
                                            <a href="{{url('admin/shop/enable_product/'.$product->id)}}" class="btn btn-info"><i class="fa fa-check"></i>
                                            </a>
                                        @endif
                                        <a href="{{url('admin/shop/delete_product/'.$product->id)}}" class="btn btn-success"><i class="fa fa-trash"></i> </a>
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