@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">POS Sale List</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <br>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all pos sale
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
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
    <div class="modal fade" id="posSaleDetailModal" tabindex="-1" role="dialog" aria-labelledby="posSaleDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="posSaleDetailModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="posSaleDetailModalBody">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
