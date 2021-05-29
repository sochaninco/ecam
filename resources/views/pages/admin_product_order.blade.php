@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product Order Listing</li>
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
                    All file for download
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?Php
                        $orderStatuses = \App\OrderStatus::get();
                    ?>
                    @include('pages.inc.admin_product_order')

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
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        $(function() {
            $('.orderStatus').on('change', function(e) {
                $(this).closest('form')
                    .trigger('submit')
            })
        })
    </script>
@endsection
