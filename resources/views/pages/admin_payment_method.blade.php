@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment Method</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('add_payment_method')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Payment Method</a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all payment
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Name</th>
                                <th> Description </th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentMethods as $method)
                            <tr class="even gradeC">
                                <td>
                                    {{$method->name}}
                                </td>
                                <td>{{$method->description}}
                                </td>
                                {{--<td>{{$category->cost}}</td>--}}
                                <td class="center">
                                    @if($method->status == 0)
                                        <a href="{{url('disable_payment_method/'.$method->id)}}" class="btn-warning btn"><i class="fa fa-times"></i> </a>
                                    @else
                                        <a href="{{url('enable_payment_method/'.$method->id)}}" class="btn-success btn"><i class="fa fa-check"></i> </a>
                                    @endif
                                    <a href="{{url('edit_payment_method/'.$method->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                                    <a href="{{url('delete_payment_method/'.$method->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payment method?');"><i class="fa fa-trash"></i>
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