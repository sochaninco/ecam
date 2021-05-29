@extends('layouts.app')
@section('title','My eCamMall')
@section('my_shop','active')
@section('my_customer_order','active')
@section('content')

    <div class="container">
        <div class="row white-bg">
            @include('pages.users.my_ecammall_menu_sell')
            <div class="col-sm-9 padding-right">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    My Coupons
                </h2>
                <div class="col-sm-3 pull-right padding-bottom">
                        <a href="{{url('em-user/'.$userId.'/new_coupons')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Coupon</a>
                </div>
                <div class="col-lg-12">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="list-product">
                                <thead>
                                <tr>
                                    <th> No</th>
                                    <th> Coupon Name </th>
                                    <th class="nosort">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $key=>$coupon)
                                    <tr class="even gradeC">
                                        <td>{{$key+1}}</td>
                                        <td>{{$coupon->type}}</td>
                                        <td class="center">
                                            <a href="{{url('em-user/coupon/'.Auth::user()->id.'/edit/'.$coupon->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{url('em-user/coupon/'.Auth::user()->id.'/delete/'.$coupon->id)}}" class="btn btn-success"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="{{asset('css/DataTables/datatables.min.js')}}"></script>
    <script type="text/javascript">
        $('#list-product').DataTable({
            responsive: true,
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': ['nosort']
            }]
        });
        $('#list-pending-order').DataTable({
            responsive: true,
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': ['nosort']
            }]
        });
    </script>
@endsection