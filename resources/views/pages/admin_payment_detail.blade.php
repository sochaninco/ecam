    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h4 class="page-header">
                <i class="fa fa-truck"></i> Order N<sup>o</sup>: {{$paymentInfo->order_id}}
                <small class="pull-right">Date: {{$paymentInfo->created_at->format('d-M-Y')}}</small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            <?php
                $customer = \App\User::find($paymentInfo->user_id);
            ?>
            Customer
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
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Code</th>
                </tr>
                </thead>
                <tbody id="item_info">
                <tr>
                    <td>{{$paymentInfo->name}}</td>
                    <td>{{$paymentInfo->sender_phone}}</td>
                    <td>{{$paymentInfo->wing_code}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

<div id="detail-payment-method"></div>
<script>
    $('#payment-method-modal').modal('show');
</script>