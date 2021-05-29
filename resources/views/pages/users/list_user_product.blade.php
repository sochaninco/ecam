@extends('layouts.app',['userId'=>$userId])
@section('title','My eCamMall')
@section('my_shop','active')
@section('my_customer_order','active')
@section('content')

    <div class="container">
        <div class="row white-bg">
            <div class="container no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>11,'page'=>3])->get();
                ?>
                <div id="brand-zone-item-carousel" data-interval="300000" data-type="multi" data-ride="carousel" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($Product_banner as $key=>$banner)
                            <div class="item @if($key == 0)active @endif ">
                                <a href="{{url('')}}" >
                                    <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('pages.users.my_ecammall_menu_sell')
            <div class="col-sm-9 padding-5px">
                <?php
                $expiredDate = date('Y-m-d',strtotime($expiredDateStr));
                $currentDate = date('Y-m-d');
                ?>

                @if($expiredDate == $currentDate)
                    <div class="alert alert-danger margin-top-30px">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Your Package was expired, <a href="{{url('em-user/'.Auth::user()->id.'/membership_list')}}"> Click Here </a> for renew
                    </div>
                @else
                    @if (Session::has('flash_notification.message'))
                        <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            {{ Session::get('flash_notification.message') }}
                        </div>
                    @endif
                    <div class="padding-bottom-15">
                        <div class="col-sm-6 col-xs-6 no-padding">
                            <h2 class="title">
                                My Product
                            </h2>
                        </div>
                        <div class="col-sm-6 col-xs-6 pull-left no-padding padding-top-5px padding-bottom-5">
                            <span>
                                @permission('item-create')
                                    @if(Auth::user()->user_role == 0)
                                        <a href="{{url('em-user/shop/'.$ShopName.'/new_product')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Product</a>
                                    @endif
                                @endpermission
                            </span>
                        </div>
                    </div>
                    <div class="hidden-xs col-lg-12 col-xs-12 no-padding">
                            <div class="dataTable_wrapper table-responsive">
                                <table class=" table table-striped table-bordered table-hover" id="list-product">
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
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        ?>
                                        <tr class="even gradeC">
                                            <td>
                                                {{--<img src="{{asset('images/thumbnails/'.$imageName)}}" class="img-responsive" width="50px">--}}
                                                <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" class="img-responsive" width="50px">
                                            </td>
                                            <td>
                                                {{$product->sku}}
                                                @if($product->promotion > 0)
                                                    <span class="label label-warning">promotion</span>
                                                @endif
                                            </td>
                                            <td>{{substr($product->name,0,20)}}...</td>
                                            {{--<td>{{$product->cost}}</td>--}}
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td class="center">
                                                @permission('item-edit')
                                                <a href="{{url('em-user/shop/'.$product->user_id.'/edit_product/'.$product->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                                </a>
                                                @endpermission
                                                @permission('item-delete')
                                                @if($product->status == 0)
                                                    <a href="{{url('user_product/'.$product->user_id.'/disable_product/'.$product->id)}}" class="btn btn-danger"><i class="fa fa-times"></i>
                                                    </a>
                                                @else
                                                    <a href="{{url('user_product/'.$product->user_id.'/enable_product/'.$product->id)}}" class="btn btn-info"><i class="fa fa-check"></i>
                                                    </a>
                                                @endif
                                                <a href="{{url('user_product/'.$product->user_id.'/delete_product/'.$product->id)}}" class="btn btn-success"><i class="fa fa-trash"></i> </a>
                                                @endpermission
                                                <?php
                                                    $date =date('Y-m-d');
                                                    $postDate = $product->updated_at;
                                                    $expiredDate = $postDate->addDays(7)->format('Y-m-d');
                                                ?>
                                                <a @if($date >= $expiredDate)href="{{url('user_product/'.$product->user_id.'/renew_product/'.$product->id)}}" class =" btn btn-info"@else class="btn btn-default disabled" @endif title="Renew"><i class="fa fa-refresh"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="visible-xs col-lg-12 col-xs-12 no-padding">
                        <div class="dataTable_wrapper table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="list-mobile-product">
                                <thead>
                                <tr>
                                    <th rowspan="2"> IMG</th>
                                    <th colspan="4"> Product Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Products as $product)
                                    <?php
                                    $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                    ?>
                                    <tr class="even gradeC">
                                        <td rowspan="2">
                                            {{--<img src="{{asset('images/thumbnails/'.$imageName)}}" class="img-responsive" width="50px">--}}
                                            <img src="http://ecammall.com/images/thumbnails/medium/{{$imageName}}" class="img-responsive" width="50px">
                                        </td>
                                        <td colspan="4">
                                            {{substr($product->name,0,32)}}...
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$product->sku}}
                                            @if($product->promotion > 0)
                                                <span class="label label-warning">Pro</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$product->price}}
                                        </td>
                                        <td>
                                            {{number_format($product->quantity,0)}}
                                        </td>
                                        <td class="center">
                                            @permission('item-edit')
                                            <a href="{{url('em-user/shop/'.$product->user_id.'/edit_product/'.$product->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                            </a>
                                            @endpermission
                                            @permission('item-delete')
                                            @if($product->status == 0)
                                                <a href="{{url('user_product/'.$product->user_id.'/disable_product/'.$product->id)}}" class="btn btn-danger"><i class="fa fa-times"></i>
                                                </a>
                                            @else
                                                <a href="{{url('user_product/'.$product->user_id.'/enable_product/'.$product->id)}}" class="btn btn-info"><i class="fa fa-check"></i>
                                                </a>
                                            @endif
                                            <a href="{{url('user_product/'.$product->user_id.'/delete_product/'.$product->id)}}" class="btn btn-success"><i class="fa fa-trash"></i> </a>
                                            @endpermission
                                            <?php
                                            $date =date('Y-m-d');
                                            $postDate = $product->updated_at;
                                            $expiredDate = $postDate->addDays(7)->format('Y-m-d');
                                            ?>
                                            <a @if($date >= $expiredDate)href="{{url('user_product/'.$product->user_id.'/renew_product/'.$product->id)}}" class =" btn btn-info"@else class="btn btn-default disabled" @endif title="Renew"><i class="fa fa-refresh"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
{{--    <script type="text/javascript" src="{{asset('css/DataTables/datatables.min.js')}}"></script>--}}
    <script type="text/javascript">

            $('#list-product').DataTable({
                responsive: true,
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': ['nosort']
                }]
            });


            $('#list-mobile-product').DataTable({
                responsive: true,
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': ['nosort']
                }]
            });
    </script>
@endsection