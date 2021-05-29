<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ecammall - Admin Site</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin-style/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('admin-style/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{asset('admin-style/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('admin-style/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('admin-style/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('admin-style/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('admin-style/bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">

    <!-- DropZone CSS -->
    {{--<link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <!-- DropZone Js -->
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

    @section('style')

    @show
</head>
<body>
@if(Auth::check())
    @include('elements.header_admin')
    @if(!Request::is('pos'))
    <div id="page-wrapper">
    @endif
        @endif
        @if (Session::has('flash_notification.message'))
            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                {{ Session::get('flash_notification.message') }}
            </div>
            @endif
            @yield('content')

            <nav class="navbar navbar-default navbar-fixed-bottom visible-xs">
            <div class="container">
                <div align="center">
                    <div class="navbar-header-custom">
                            <a class="navbar-brand" href="{{url('/')}}">
                                <i class="fa fa-home"></i>
                                <p>Home</p>
                            </a>
                            @if(\Request::is('shop/*'))
                                <?php

                                ?>
                                <a class="navbar-brand" href="{{url('shop/'.$userId.'/shop_category')}}">
                                    <i class="fa fa-list-ul"></i>
                                    <p>Category</p>
                                </a>
                            @else
                                <a class="navbar-brand" href="{{url('all_category')}}">
                                    <i class="fa fa-list-ul"></i>
                                    <p>Category</p>
                                </a>
                            @endif
                            <a class="navbar-brand" href="{{url('shopping-cart')}}">
                                <i class="fa fa-shopping-cart"></i>
                                <p>Cart</p>
                            </a>
                            <a class="navbar-brand" href="{{url('#')}}">
                                <i class="fa fa-envelope"></i>
                                <p>Message</p>
                            </a>
                    </div>
                </div>
            </div><!-- /.container-->
        </nav>

            <!-- jQuery -->
            <script src="{{asset('admin-style/bower_components/jquery/dist/jquery.min.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src="{{asset('admin-style/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="{{asset('admin-style/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

            <!-- DataTables JavaScript -->
            <script src="{{asset('admin-style/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('admin-style/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>
            <!-- Date Range-->
            <script src="{{asset('admin-style/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

            <!-- Custom Theme JavaScript -->
            <script src="{{asset('admin-style/dist/js/sb-admin-2.js')}}"></script>
            <!-- Page-Level Demo Scripts - Tables - Use for reference -->
            <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
            <script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
            <script>
                $('textarea').ckeditor();
                // $('.textarea').ckeditor(); // if class is prefered.


            </script>
            <script type="text/javascript">
                $(function () {
                    $('.start_date').datetimepicker({
                        format: "dd/MM/yyyy",
                        autoclose: true,
                        todayBtn: true,
                        pickerPosition: "bottom-left"
                    });
                    $('.end_date').datetimepicker({
                        format: "dd/MM/yyyy",
                        autoclose: true,
                        todayBtn: true,
                        pickerPosition: "bottom-left"
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#dataTables-example').DataTable({
                        responsive: true,
                        'aoColumnDefs': [{
                            'bSortable': false,
                            'aTargets': ['nosort']
                        }],
                        rowReorder: true,
                        scrollY: 300,
                    });
                    $('.product-order-list').DataTable({
                        "columnDefs": [
                            { "width": "20%", "targets": 9 }
                        ],
                        responsive: true,
                        'aoColumnDefs': [{
                            'bSortable': false,
                            'aTargets': ['nosort']
                        }],
                        "order": [[ 1, "asc" ]],
                        scrollY: 300,
                    });
                    $('.payment-list').DataTable({
                        responsive: true,
                        'aoColumnDefs': [{
                            'bSortable': false,
                            'aTargets': ['nosort']
                        }],
                        "order": [[ 0, "desc" ]],
                    });

                    $('#category_id').change(function(){
                        var categoryID = $(this).val();
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/get_categoryID/"+categoryID,
                            success: function(subcat) {
                                $('#sub_category_id').html(subcat);

                            }
                        });
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/get_brand/"+categoryID,
                            success: function(brand) {
                                $('#brand').html(brand);
                            }
                        });
                    });
                    $('#category_slide').change(function () {
                        var categoryID = $(this).val();
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/get_categoryID_to_product/"+categoryID,
                            success: function(content) {
                                $('#product_id').html(content);
                            }
                        });
                    });
                    $('#price').keyup(function () {
                        var price = $(this).val();
                        var discountRate = $('#discount_rate').val();
                        var price_after_discount = $('#price_after_discount').val();
                        if(discountRate.length == 0){
                            $('#price_after_discount').val(price);
                        }else{
                            var result = Number(price *(1-discountRate/100)).toFixed(2);
                            $('#price_after_discount').val(result);
                        }
                    });
                    $('#discount_rate').keyup(function () {
                        var price = $('#price').val();
                        var discountRate = $('#discount_rate').val();
                        var price_after_discount = $('#price_after_discount').val();
                        if(discountRate > 100){
                            alert('Discount Can not Bigger than 100');
                            $('#discount_rate').val(0);
                            $('#price_after_discount').val(price);
                        }else{
                            if(price.length == 0){
                                $('#price_after_discount').val(price);
                            }else{
//                var result = Number(price -((discountRate/100)*price)).toFixed(2);
                                var result = Number(price *(1-discountRate/100)).toFixed(2);
                                $('#price_after_discount').val(result);
                            }
                        }
                    });
                    $('.custom_field_block').hide();
                    $('.custom_field').click(function(){
                        if($(this).prop("checked") == true){
                            $('.custom_field_block').show();
                        }
                        else if($(this).prop("checked") == false){
                            $('.custom_field_block').hide();
                        }
                    });

                    $('.promotion_block').hide();
                    $('.promotion').click(function(){
                        if($(this).prop("checked") == true){
                            $('.promotion_block').show();
                        }
                        else if($(this).prop("checked") == false){
                            $('.promotion_block').hide();
                        }
                    });

                    $(".delete_thumb").click(function(){
                        if(confirm('You sure to remove this image ?')) {
                            var id = $(this).attr('id');
                            var $row = $(this).parents('.row_thumb');
                            $row.remove();
                            $.ajax({
                                dataType:"html",
                                type:"GET",
                                evalScripts: true,
                                url:'{{url('delete_thumbnail')}}/'+id,
                                success:function () {
                                }
                            })

                        }
                    });
                    $(".delete_thumb_admin").click(function(){
                        if(confirm('You sure to remove this image ?')) {
                            var id = $(this).attr('id');
                            var $row = $(this).parents('.row_thumb');
                            $row.remove();
                            $.ajax({
                                dataType:"html",
                                type:"GET",
                                evalScripts: true,
                                url:'{{url('delete_thumbnail_admin')}}/'+id,
                                success:function () {
                                }
                            })

                        }
                    });
                    $(".delete_feature_image").click(function(){
                        if(confirm('You sure to remove this image ?')){
                            var id = $(this).attr('id');
                            var type = $(this).attr('name');
                            $.ajax({
                                dataType:"html",
                                type:"GET",
                                evalScripts: true,
                                url:'{{url('delete_feature_image')}}/'+type+'/product_id/'+id,
                                success:function () {
                                    if(type == 1){
                                        $(".feature_image").remove();
                                    }
                                    else if(type == 2){
                                        $(".feature_image_1").remove();
                                    }
                                    else if(type == 3){
                                        $(".feature_image_2").remove();
                                    }
                                    else if(type == 4){
                                        $(".feature_image_3").remove();
                                    }
                                    else if(type == 5){
                                        $(".feature_image_4").remove();
                                    }
                                }
                            })
                        }
                    });

                    <?php
                        $pageManagements = \App\PageManagement::get();
                    ?>
                    @foreach($pageManagements as $page)
                       $('.{{$page->block}}').click(function(){
                        var status = $(this).val();
                        var block = $(this).attr('name');
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/page_management/"+status+"/"+block,
                            success: function() {
                                alert('update successfully');

                            }
                        });
                    });
                    @endforeach
                    /*$('.pro_cat_home_page').click(function(){
                        var status = $(this).val();
                        var block = $(this).attr('name');
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/page_management/"+status+"/"+block,
                            success: function() {
                                alert('update successfully');

                            }
                        });
                    });
                    $('.pro_city_brand_page').click(function () {
                        var status = $(this).val();
                        var block = $(this).attr('name');
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/page_management/"+status+"/"+block,
                            success: function() {
                                alert('update successfully');

                            }
                        });
                    });

                    $('.recomment_item_home_page').click(function () {
                        var status = $(this).val();
                        var block = $(this).attr('name');
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/page_management/"+status+"/"+block,
                            success: function() {
                                alert('update successfully');

                            }
                        });
                    });
                    $('.header_top_menu').click(function () {
                        var status = $(this).val();
                        var block = $(this).attr('name');
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/page_management/"+status+"/"+block,
                            success: function() {
                                alert('update successfully');

                            }
                        });
                    });*/

                    $("#shop_name").keyup(function(){
                        var shopName = $(this).val();
                        var baseUrl = 'http://ecammall.com/shop/';
                        var website = baseUrl+shopName;
                        $("#website").val(website);
                    });
                    function convertToSlug(shopName)
                    {
                        return shopName
                            .toLowerCase()
                            .replace(/ /g,'-')
                            .replace(/[^\w-]+/g,'')
                            ;
                    }

                    $("#name").keyup(function(){
                        var name = $(this).val();
                        name = name.toLowerCase();
                        name = name.replace(/[^a-zA-Z0-9]+/g,'-');
                        $("#slug").val(name);
                    });

                    <?php
                        if(Request::is('edit_search_keyword/*')){
                    ?>
                    if($('#type').val() == 1){
                        $('.shop_exhibition').show();
                        $('.keyword-category').hide();
                        $('.keyword-subcategory').hide();
                        $('.link_to').hide();
                    }else{
                        $('.keyword-category').show();
                        $('.keyword-subcategory').show();
                        $('.shop_exhibition').hide();
                        $('.link_to').show();
                    }
                    <?php
                        }
                        else{
                    ?>
                    $('.keyword-category').hide();
                    $('.keyword-subcategory').hide();
                    $('.shop_exhibition').hide();
                    $('.link_to').hide();
                    <?php
                        }
                    ?>



                    $('body').delegate('#type','change',function () {
                        var type = $(this).val();
                        if(type == 0){
                            $('.link_to').show();
                            $('.shop_exhibition').hide();
                        }else if(type == 1){
                            $('.shop_exhibition').show();
                            $('.link_to').hide();
                        }
                    });
                    $('body').delegate('#shop','change',function () {
                        var shop = $(this).val();
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/get_category_by_shop/" + shop,
                            success: function (product) {
                                $('#product_by_shop').html(product);

                            }
                        })
                    });
                    $('body').delegate('#category_id','change',function () {
                        var categoryID = $(this).val();
                        if($('#link_to').val() ==2){
                            $('.keyword-subcategory').show();
                        }

                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/get_categoryID/" + categoryID,
                            success: function (subcat) {
                                $('#sub_category_id').html(subcat);

                            }
                        });
                    });
                    $('body').delegate('#link_to','change',function () {
                        var linkTo = $(this).val();
                        if(linkTo == 1){
                            $('.keyword-category').show();
                            $('.keyword-subcategory').hide();
                        }else if(linkTo == 2){
                            $('.keyword-category').show();
                        }else{
                            $('.keyword-category').hide();
                            $('.keyword-subcategory').hide();
                        }
                    });

                    $('body').delegate('#category_admin_product','change',function () {
                        var categoryID = $(this).val();
                        getSubcategory(categoryID);
                    })
                    function getSubcategory(categoryID) {
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/get_categoryID/"+categoryID,
                            success: function(subcat) {
                                $('#subcategory_id').html(subcat);
                            }
                        });
                    }

                    $('body').delegate('.admin-product-detail','click',function () {
                        var proID = $(this).attr('id');
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/get_admin_product_detail_popUp/" + proID,
                            success: function (content) {
                                $('#productDetailModalBody').html(content);

                            }
                        });
                    });
                    $('body').delegate('.admin-product-image','click',function (){
                       var proID = $(this).attr('id');
                       $('#productImageModalBody').empty();
                       $.ajax({
                           dataType : "html",
                           type:"GET",
                           evalScripts:true,
                           url: "/get_admin_product_image_popUp/"+proID,
                           success: function (content){
                               $('#productImageModalBody').html(content);
                           }
                       })
                    });
                    $('body').delegate('.pos-sale-detail','click',function () {
                        var saleID = $(this).attr('id');
                        $.ajax({
                            dataType: "html",
                            type: "GET",
                            evalScripts: true,
                            url: "/get_pos_sale_detail_popUp/" + saleID,
                            success: function (content) {
                                $('#posSaleDetailModalBody').html(content);

                            }
                        });
                    });
                });
            </script>

        {{--<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>--}}

</body>
</html>
