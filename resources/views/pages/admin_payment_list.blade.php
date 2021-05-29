@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment List</li>
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
                    All payment listing
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover payment-list">
                            <thead>
                            <tr>
                                <th> OrderID</th>
                                <th> Customer Name </th>
                                <th> Customer Number</th>
                                <th> Amount</th>
                                <th> Total</th>
                                <th> Payment Method</th>
                                <th> Payment Status</th>
                                <th> Created Date</th>
                                <th class="nosort" style="width: 10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentLists as $payment)
                                <tr class="even gradeC">
                                    <td><a style="cursor: pointer" id="{{$payment->id}}" class="invoice_detail"> {{$payment->id}} </a></td>
                                    <td>{{$payment->first_name.' '.$payment->last_name}}</td>
                                    <td>{{$payment->order_phone}}</td>
                                    <td>$ {{$payment->amount}}</td>
                                    <td>$ {{$payment->total}}</td>
                                    <td>
                                        @if($payment->payment_method == 0)
                                            Cash On Delivery
                                        @else
                                            <a style="cursor: pointer" id="{{$payment->id}}" class="payment_method_detail">
                                            Wing Transfer
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($payment->payment_status == 0)
                                            <a class="btn btn-danger">Pending</a>

                                        @else
                                            <a class="btn btn-success">Confirmed</a>
                                        @endif
                                            <a href="{{url('admin_payment_delete/'.$payment->id)}}" class="btn btn-danger" onclick="return confirm('Do you want to delete this payment');"><i class="fa fa-trash"></i> </a>
                                    </td>
                                    <td>{{$payment->created_at->format('d-M-Y')}}</td>
                                    <td class="center">
                                        @if($payment->payment_status == 0)
                                        {!! Form::open(['url'=>url('admin_payment_confirm/'.$payment->id),'method'=>'POST','files'=>true,'role'=>'form']) !!}
                                            <input type="submit" value="Confirm" class="btn btn-info">
                                        {!! Form::close() !!}
                                        @else
                                        <!-- Button trigger modal -->
                                            <a style="cursor: pointer" id="{{$payment->id}}" class="invoice_detail btn btn-primary">Invoice</a>
                                        @endif
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
    <!--Modal -->
    <div class="modal fade invoice-modal" id="invoice-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Invoice Detail</h4>
                </div>
                <div class="modal-body" id="detail-success">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default pull-left" type="button" data-dismiss="modal">Close</button>
                    <a href="{{url('payment_list/')}}" class="btn btn-primary" type="button"> <i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!--Modal Payment Method -->
    <div class="modal fade payment-method-modal" id="payment-method-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Payment Detail</h4>
                </div>
                <div class="modal-body" id="detail-payment-method">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default pull-left" type="button" data-dismiss="modal">Close</button>
                    {{--<button class="btn btn-primary" type="button"> <i class="fa fa-print"></i> Print</button>--}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /#page-wrapper -->
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>

        $(function() {
            $('.orderStatus').on('change', function(e) {
                $(this).closest('form')
                    .trigger('submit')
            })
        })
        $('body').delegate('.invoice_detail','click',function () {
            var ID=$(this).attr('id');
            $.ajax({
                dataType:"html",
                type:"GET",
                evalScript:true,
                url:"/show_invoice/"+ID,
                success:function(content){
                    $("#detail-success").html(content);
                    $("#detail-success").css({display:"block"});
                }
            });
        });
        $('body').delegate('.payment_method_detail','click',function () {
            var ID=$(this).attr('id');
            $.ajax({
                dataType:"html",
                type:"GET",
                evalScript:true,
                url:"/show_payment_method/"+ID,
                success:function(content){
                    $("#detail-payment-method").html(content);
                    $("#detail-payment-method").css({display:"block"});
                }
            });
        });

    </script>
@endsection