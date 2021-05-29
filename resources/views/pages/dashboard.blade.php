@extends('layouts.app_admin')
@section('content')
    @if(Auth::user()->user_role == 1)
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-barcode fa-5x"></i>
                                </div>
                                <div class="col-xs-6 text-right">
                                    @php
                                        $countProduct = \App\Product::count();
                                    @endphp
                                    <p class="announcement-heading">{{$countProduct}}</p>
                                    <p class="announcement-text">Total Products</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('admin_product')}}">
                            <div class="panel-footer announcement-bottom">
                                <div class="row">
                                    <div class="col-xs-6">
                                        View Details
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    @php
                                        $getSale = \Illuminate\Support\Facades\DB::table('sma_sales')->whereDate('date', '=', date('Y-m-d'))->get();
                                        $totalSale = 0;
                                        foreach ($getSale as $sale){
                                            $totalSale += $sale->grand_total;
                                        }
                                    @endphp
                                    <p class="announcement-heading">{{$totalSale}}</p>
                                    <p class="announcement-text">Total Sales</p>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer announcement-bottom">
                                <div class="row">
                                    <div class="col-xs-6">
                                        Complete Sales
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                                @php
                                    $countCustomer = \Illuminate\Support\Facades\DB::table('sma_companies')->where('group_name','customer')->count();
                                @endphp
                                <p class="announcement-heading">{{$countCustomer}}</p>
                                <p class="announcement-text">Total Customer</p>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer announcement-bottom">
                            <div class="row">
                                <div class="col-xs-6">
                                    View Details
                                </div>
                                <div class="col-xs-6 text-right">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
                <div class="col-lg-3">
                    <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-5">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                @php
                                    $getSaleToday = \Illuminate\Support\Facades\DB::table('sma_sales')
                                        ->join('sma_sale_items','sma_sales.id','sma_sale_items.sale_id')
                                        ->join('sma_products','sma_sale_items.product_id','sma_products.id')
                                        ->select('sma_sales.*','sma_sale_items.unit_price','sma_sale_items.quantity','sma_products.cost')
                                        ->whereDate('date','2016-10-18')->get();
                                    $totalCost = 0;
                                    $totalPrice = 0;
                                    foreach ($getSaleToday as $sale){
                                        $totalCost += $sale->cost;
                                    }

                                @endphp
                                <p class="announcement-heading">{{$totalCost}}</p>
                                <p class="announcement-text">Today Profit</p>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer announcement-bottom">
                            <div class="row">
                                <div class="col-xs-6">
                                    View Details
                                </div>
                                <div class="col-xs-6 text-right">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-key"></i> </a>
                    <br><span>Search</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-puzzle-piece"></i> </a>
                    <br><span>Products</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-barcode"></i> </a>
                    <br><span>Print</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-arrow-circle-o-down"></i> </a>
                    <br><span>Admin</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-dollar"></i> </a>
                    <br><span>Packages</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-info"></i> </a>
                    <br><span>Transaction</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-dollar"></i> </a>
                    <br><span>Payment</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-paypal"></i> </a>
                    <br><span>Payment </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-dropbox"></i> </a>
                    <br><span>Customer </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-truck"></i> </a>
                    <br><span>Seller </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-search"></i> </a>
                    <br><span>Order </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-th-list"></i> </a>
                    <br><span>Categories</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-th-list"></i> </a>
                    <br><span>Subcategories</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-folder-o"></i> </a>
                    <br><span>Brand</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-dropbox"></i> </a>
                    <br><span>Slide </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-dropbox"></i> </a>
                    <br><span>Promotion </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-mobile"></i> </a>
                    <br><span>Banner </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-image"></i> </a>
                    <br><span>Pop Up </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-folder-o"></i> </a>
                    <br><span>Footer </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-file"></i> </a>
                    <br><span>Footer </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-user"></i> </a>
                    <br><span>User</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-key"></i> </a>
                    <br><span>Role</span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-file"></i> </a>
                    <br><span>Page </span>
                </div>
                <div class="col-sm-1 col-xs-3 padding-bottom-15" align="center">
                    <a href="{{url('#')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-tasks"></i> </a>
                    <br><span>Theme </span>
                </div>
            </div>
            <hr>
            <br>
            @include('pages.inc.admin_product_order')
            <hr>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="{{url('#')}}" data-toggle="tab">POS Sale</a>
                </li>
                <li>
                    <a href="{{url('#')}}" data-toggle="tab">Sale</a>
                </li>
                <li>
                    <a href="{{url('#')}}" data-toggle="tab">Transfer</a>
                </li>
                <li>
                    <a href="{{url('#')}}" data-toggle="tab">Quotation</a>
                </li>
            </ul>
            <div class="tab-content ">
                <br>
                <div class="tab-pane active">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Date</th>
                                <th> Reference No</th>
                                <th> Customer </th>
                                <th> Biller</th>
                                <th> Warehouse </th>
                                <th> Total Item</th>
                                <th> Total</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posSales as $pos)
                                <tr class="even gradeC">
                                    <td>{{$pos->created_at->format('d-M-Y')}}</td>
                                    <td>{{$pos->reference_no}}</td>
                                    <td>{{$pos->customer}}</td>
                                    <td>{{$pos->user->last_name}}</td>
                                    <td>{{$pos->warehouse->name}}</td>
                                    <td>{{$pos->total_items}}</td>
                                    <td>$ {{number_format($pos->total,2)}}</td>
                                    <td class="center">
                                        <a data-toggle="modal" data-target="#posSaleDetailModal" id="{{$pos->id}}" class="pos-sale-detail btn btn-info"><i class="fa fa-book"></i></a>
                                        {{--<button type="button" class="btn btn-danger"><i class="fa fa-times"></i>--}}
                                        {{--</button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane"></div>
                <div class="tab-pane"></div>
                <div class="tab-pane"></div>

            </div>


        <!-- /.row -->
        </div>
    </div>
    <!-- /#page-wrapper -->
    @endif
@endsection
