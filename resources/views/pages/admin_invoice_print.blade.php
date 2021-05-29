<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ECammall | Invoice No {{$order->id}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        @page {
            /* dimensions for the whole page */
            size: A4;
            margin: 10px;
        }
        html {
            /* off-white, so body edge is visible in browser */
            background: #eee;
        }
        body {
            /* A5 dimensions */
            font: normal 11px sans-serif;
            /*height: 210mm;*/
            height: auto;
            width: 148.5mm;
            margin: 5px;
            padding:0;
            /*position: relative;*/
            min-height: 100%;
        }
        .table-invoice{
            width: 100%;
            margin-bottom: 10px;
        }
        .invoice-print{
            padding: 0 10px;
        }
        .table-invoice>thead>tr>th, .table-invoice>tbody>tr>th, .table-invoice>tfoot>tr>th, .table-invoice>thead>tr>td, .table-invoice>tbody>tr>td, .table-invoice>tfoot>tr>td{
            border: 1px solid #000000;
        }
        .table-invoice>tbody>tr>td, .table-invoice>tbody>tr>th, .table-invoice>tfoot>tr>td, .table-invoice>tfoot>tr>th, .table-invoice>thead>tr>td, .table-invoice>thead>tr>th{
            padding: 6px;
            line-height: 1.42857143;
            vertical-align: top;
        }
        .item-detail-sold{
            font-size: 14px;
        }

        .footer-invoice{
            /*width: 100%;*/
            bottom: 0;
            /*left: 0;*/
            /*height: 55mm;*/
            margin: 0 25px;
            /*padding: 0;*/
            /*position: relative;*/
            /*right: 0;*/
            /*text-align: center;*/
            /*display: inline-block;*/
            /*clear: both;*/
            /*position: absolute;*/
            /*z-index: 10;*/
            /*height: 3em;*/
            /*margin-top: -3em;*/
        }
        /*#footer{*/
            /*!*background:#ffab62;*!*/
            /*width:100%;*/
            /*!*height:210mm;*!*/
            /*position:absolute;*/
            /*bottom:0;*/
            /*left:0;*/
        /*}*/
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="window.print();">
<div class="wrapper">
    <!-- Main content -->
    <div class="invoice-print">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12 page-header">
                <div class="col-xs-3">
                    <img src="{{asset('images/logo.jpg')}}" class="img-responsive">
                </div>
                <div class="col-xs-9 no-padding">
                    <h2 class="page-header" style="border: none">
                        Invoice No : {{$order->id}}
                        <small><b>Date:</b> {{$order->created_at->format('d-M-Y')}}</small>
                    </h2>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                <?php
                $customer = \App\User::find($order->user_id);
                ?>
                Ship To :
                <address>
                    <strong>Customer Name : {{$customer->first_name.' ' .$customer->last_name}}</strong><br>
                    Address : {{$customer->address}}<br>
                    Phone: {{$customer->phone}}<br>
                    Email: {{$customer->email}}
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.col -->
        {{--<!-- info row -->--}}
        {{--<div class="row col-sm-12 col-md-12 invoice-info">--}}
            {{----}}
        {{--</div>--}}
        {{--<!-- /.row -->--}}

        <!-- Table row -->
        <div class="row item-detail-sold">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>UOM</th>
                        <th>Qty</th>
                        <th width="70px">Price</th>
                        <th>Amount</th>
                        <th>Remark</th>
                    </tr>
                    </thead>
                    <tbody id="item_info">
                    @foreach($order->ProductOrderDetail as $key=>$detail)
                        <?php
                        if($detail->product_from == 0){
                            $productInfo = \App\ShopProduct::where('id',$detail->product_id)->first();
                            $unit = $productInfo->unit;
                        }else{
                            $productInfo = \App\Product::where('id',$detail->product_id)->first();
                            if($productInfo->unit == 1){
                                $unit = 'pc';
                            }elseif ($productInfo->unit == 2){
                                $unit = 'cm';
                            }elseif ($productInfo->unit == 3){
                                $unit = 'm';
                            }elseif ($productInfo->unit == 4){
                                $unit = 'ea';
                            }else{
                                $unit = 'kg';
                            }
                        }
                        ?>
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{substr($productInfo->name,0,40)}} @if(strlen($productInfo->name) > 40) ... @endif</td>
                            <td>{{$unit}}</td>
                            <td>{{$detail->qty}}</td>
                            <td>$ {{number_format($detail->price,2)}}</td>
                            <td>$ {{number_format($detail->amount,2)}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-6 pull-right">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:60%">Subtotal:</th>
                            <td>$ {{number_format($order->amount,2)}}</td>
                        </tr>
                        <tr>
                            <th>Discount(%):</th>
                            <td>{{$order->discount}}</td>
                        </tr>
                        <tr>
                            <th>Shipping Fee :</th>
                            <td>{{$order->shipping_cost}}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>$ {{number_format($order->total,2)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <!-- /.row -->
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>

