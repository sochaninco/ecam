<!-- title row -->
<div class="row">
    <div class="col-xs-12">
        <h4 class="page-header">
            <i class="fa fa-truck"></i> Order N<sup>o</sup>: {{$posSaleDetail->reference_no}}
            <small class="pull-right">Date: {{$posSaleDetail->created_at->format('d-M-Y')}}</small>
        </h4>
    </div>
    <!-- /.col -->
</div>
<!-- info row -->
<div class="row invoice-info">
    <div class="col-sm-6 invoice-col">
        <address>
            <strong>Date : {{$posSaleDetail->created_at->format('d-M-Y H:i')}}</strong><br>
            <strong>Sale Ref : {{$posSaleDetail->reference_no}}</strong><br>
            <strong>Biller : {{$posSaleDetail->user->last_name}}</strong><br>
            <strong>Customer Name : {{$posSaleDetail->customer}}</strong><br>
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
                <th>Name</th>
                <th width="15%">Price</th>
            </tr>
            </thead>
            <tbody id="item_info">
            @foreach($posSaleDetail->posSaleDetail as $item)
            <tr>
                <td>{{$item->product_name}}
                    <br>
                    ({{number_format($item->quantity,2)}} * {{number_format($item->net_price,2)}})</td>
                <td>$ {{number_format($item->net_price*$item->quantity,2)}}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>$ {{number_format($posSaleDetail->total,2)}}</th>
                </tr>
                <tr>
                    <th>Order Discount</th>
                    <th>
                        @if($posSaleDetail->discount_type == 'percent')
                            %
                        @else
                            $
                        @endif
                        {{number_format($posSaleDetail->total_discount,2)}}
                    </th>
                </tr>
                <tr>
                    <th>
                        Grand Total
                    </th>
                    <th>
                        $ {{number_format($posSaleDetail->grand_total,2)}}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-xs-12">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button onclick="window.print();" class="btn btn-block btn-primary">Print</button>                    </div>
            <div class="btn-group" role="group">
                <a class="btn btn-block btn-success" href="#" id="email">Email</a>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>

<script>
    $('#posSaleDetailModalLabel').text('{{$posSaleDetail->reference_no }}')
</script>
