    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h4 class="page-header">
                <i class="fa fa-truck"></i> Order N<sup>o</sup>: {{$order->id}}
                <small class="pull-right">Date: {{$order->created_at->format('d-M-Y')}}</small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
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
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>UOM</th>
                    <th>Qty</th>
                    <th>Price</th>
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
    <!-- /.row -->

    <div class="row">
        <div class="col-xs-6 pull-right">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:78%">Subtotal:</th>
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

    <div class="row no-print">
        <div class="col-xs-12">
            <a href="{{url('admin_payment_list/'.$order->id.'/print')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            {{--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment--}}
            {{--</button>--}}
            {{--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">--}}
            {{--<i class="fa fa-download"></i> Generate PDF--}}
            {{--</button>--}}
        </div>
    </div>
<div id="detail_success"></div>
<script>
    $('#invoice-modal').modal('show');
</script>