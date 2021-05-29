@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaction List</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-12">
            <a href="{{url('add_new_transaction')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i>Add new Transaction </a>
        </div>
        <br>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your transaction
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> ID</th>
                                <th> Packages Name </th>
                                <th> UserID/UserName</th>
                                <th> payment Method </th>
                                <th> Status</th>
                                <th> Phone </th>
                                <th> Wing Code</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $type = [0=>"Wing Transfer",1=>"Bank Transfer"]
                            ?>
                            @foreach($transactions as $transaction)
                            <tr class="even gradeC">
                                <td>{{$transaction->id}}</td>
                                <td>{{$package[$transaction->package_id]}}</td>
                                <td>({{$transaction->user_id}})-{{$user[$transaction->user_id]}}</td>
                                <td>{{$type[$transaction->payment_type]}}</td>
                                <th>
                                    @if($transaction->status == 0)
                                        Pending
                                    @else
                                        Approved
                                    @endif
                                </th>
                                <td>{{$transaction->phone}}</td>
                                <td>{{$transaction->wing_code}}</td>
                                <td class="center">
                                    @if($transaction->status ==0)
                                    <a href="{{url('transaction_approve/'.$transaction->id)}}" class="btn btn-info"><i class="fa fa-check"></i>
                                    </a>
                                    @endif
                                    <a href="{{url('transaction_delete/'.$transaction->id)}}" class="btn btn-danger"><i class="fa fa-times"></i> </a>
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