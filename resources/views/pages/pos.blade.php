@extends('layouts.app_admin')
    <!-- POS CSS -->
    <link href="" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin-style/pos/css/posajax.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('admin-style/pos/css/print.css')}}" type="text/css" media="print"/>
    <style>
        .table > thead:first-child > tr:first-child > th, .table > thead:first-child > tr:first-child > td, .table-striped thead tr.primary:nth-child(odd) th {
            background-color: #428BCA;
            color: white;
            border-color: #357EBD;
            border-top: 1px solid #357EBD;
            text-align: center;
            font-size: 12px;
        }
        .sname{
            font-size: 12px;
        }
    </style>

@section('content')
    <div id="content">
        <div class="c1">
            <div class="pos">
                <div id="pos">
                    {!! Form::open(['files'=>true,'role'=>'form','method'=>'post','role'=>'form','id'=>'pos-sale-form']) !!}
                        <div id="leftdiv">
                            <div id="printhead">
                                <h4 style="text-transform:uppercase;">SOCHAN DBMS</h4>
                                <h5 style="text-transform:uppercase;">Order List</h5>Date 15/10/2020 09:51                        </div>
                            <div id="left-top">
                                <div style="position: absolute; left:-9999px;"><input type="text" name="test" value="" id="test" class="kb-pad ui-keyboard-input ui-widget-content ui-corner-all" aria-haspopup="true" role="textbox">
                                </div>
                                <div class="form-group">
                                    <div class="input-group" style="z-index:1;">
                                        <select class="form-control pos-input-tip" name="customer" style="width: 100%;" tabindex="-1" id="poscustomer">
                                            <option value="Walk-In-Customer">Walk-In Customer</option>
                                        </select>
                                        <div class="input-group-addon no-print" style="padding: 2px 8px; border-left: 0;">
                                            <a href="#" id="toogle-customer-read-attr" class="external" tabindex="-1">
                                                <i class="fa fa-pencil" id="addIcon" style="font-size: 1.2em;"></i>
                                            </a>
                                        </div>
                                        <div class="input-group-addon no-print" style="padding: 2px 7px; border-left: 0;">
                                            <a href="#" id="view-customer" class="external" data-toggle="modal" data-target="#myModal" tabindex="-1">
                                                <i class="fa fa-eye" id="addIcon" style="font-size: 1.2em;"></i>
                                            </a>
                                        </div>
                                        <div class="input-group-addon no-print" style="padding: 2px 8px;">
                                            <a href="https://heangsochan.com/stock/admin/customers/add" id="add-customer" class="external" data-toggle="modal" data-target="#myModal" tabindex="-1">
                                                <i class="fa fa-plus-circle" id="addIcon" style="font-size: 1.5em;"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div class="no-print">
                                    <div class="form-group" id="ui">
                                        <select class="form-control pos-input-tip" name="warehouse_id" id="poswarehouse" style="width: 100%;" tabindex="-1">
                                            @foreach($warehouses as $warehouse)
                                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                            @endforeach
                                        </select>
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                                <div class="no-print">
                                    <div class="form-group" id="ui">
                                        <input type="text" name="add_item" value="" class="form-control pos-tip ui-autocomplete-input" id="add_item" data-placement="top" data-trigger="focus" placeholder="Scan/Search product by name/code" title="" autocomplete="off" data-original-title="Please start typing code/name for suggestions or just scan barcode">
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="print">
                                <div id="left-middle" style="height: 176px; min-height: 278px;">
                                    <div id="product-list" class="ps-container" style="height: 176px; min-height: 278px;">
                                        <table class="table items table-striped table-bordered table-condensed table-hover sortable_table" id="posTable" style="margin-bottom: 0px; padding: 0px;">
                                            <thead class="tableFloatingHeaderOriginal">
                                            <tr>
                                                <th width="40%">Product</th>
                                                <th width="15%">Price</th>
                                                <th width="15%">Qty</th>
                                                <th width="20%">Subtotal</th>
                                                <th style="width: 5%; text-align: center;">
                                                    <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="ui-sortable" id="pos-product-sale">
                                                <?php
                                                    $posSaleTmp = \App\Product::join('pos_sale_tmp','sma_products.id','=','pos_sale_tmp.product_id')
                                                        ->select('sma_products.*','pos_sale_tmp.qty')->where('pos_sale_tmp.user_id',Auth::user()->id)->get();
                                                ?>
                                                @if(count($posSaleTmp) > 0)
                                                    @foreach($posSaleTmp as $key=>$product)
                                                        <tr id="row_{{$product->code}}" class="row_{{$product->code}} item_order sname" data-item-id="{{$product->code}}">
                                                        <td>
                                                            <input name="item[{{$key}}][product_id]" type="hidden" class="rid" value="{{$product->id}}">
                                                            <input name="item[{{$key}}][product_type]" type="hidden" class="rtype" value="standard">
                                                            <input name="item[{{$key}}][product_code]" type="hidden" class="rcode" value="{{$product->code}}">
                                                            <input name="item[{{$key}}][product_name]" type="hidden" class="rname" value="{{$product->name}}">
                                                            <input name="item[{{$key}}][product_comment]" type="hidden" class="rcomment" value="">
                                                            <span class="sname" id="name_{{$product->code}}">
                                                            {{$product->code}} - {{$product->name}}
                                                        </span>
                                                            {{--                                                        <span class="lb"></span>--}}
                                                            {{--                                                        <i class="pull-right fa fa-edit fa-bx tip pointer edit" id="41e7aa85cadf59ac1bb7b13d213aac8f7f37927a" data-item="41e7aa85cadf59ac1bb7b13d213aac8f7f37927a" title="Edit" style="cursor:pointer;"></i>--}}
                                                            {{--                                                        <i class="pull-right fa fa-comment fa-bx-o tip pointer comment" id="41e7aa85cadf59ac1bb7b13d213aac8f7f37927a" data-item="41e7aa85cadf59ac1bb7b13d213aac8f7f37927a" title="Comment" style="cursor:pointer;margin-right:5px;"></i>--}}
                                                        </td>
                                                        <td class="text-right">
                                                            <input class="form-control input-sm rserial" name="item[{{$key}}][serial]" type="hidden" id="serial_{{$product->code}}" value="">
                                                            <input class="form-control input-sm rdiscount" name="item[{{$key}}][product_discount]" type="hidden" id="discount_{{$product->code}}" value="{{$product->promotion}}">
                                                            <input class="rprice" name="item[{{$key}}][net_price]" type="hidden" id="price_{{$product->code}}" value="{{$product->price}}">
                                                            <input class="ruprice" name="item[{{$key}}][unit_price]" type="hidden" value="{{$product->cost}}">
                                                            <input class="realuprice" name="item[{{$key}}][real_unit_price]" type="hidden" value="{{$product->price - $product->cost}}">
                                                            <span class="text-right sprice" id="sprice_{{$product->price}}">{{number_format($product->price,2)}}</span>
                                                        </td>
                                                        <td>
                                                            <input class="form-control text-center rquantity" tabindex="2" name="item[{{$key}}][quantity]" type="text" value="{{$product->qty}}" data-id="{{$product->code}}" data-item="{{$product->code}}" id="quantity_{{$product->code}}" onclick="this.select();" role="textbox">
                                                            <input name="item[{{$key}}][product_unit]" type="hidden" class="runit" value="{{$product->unit}}">
                                                            <input name="item[{{$key}}][product_base_quantity]" type="hidden" class="rbase_quantity" value="{{$product->quantity}}">
                                                        </td>
                                                        <td class="text-right">
                                                            <input type="hidden" class="subtotal" value="{{$product->qty*$product->price}}">
                                                            <span class="text-right ssubtotal" id="subtotal_{{$product->code}}">{{number_format($product->qty*$product->price,2)}}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <i class="fa fa-times tip pointer remove_item_order" id="{{$product->code}}" title="Remove" style="cursor:pointer;"></i>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div style="clear:both;"></div>
                                        <div class="ps-scrollbar-x-rail" style="width: 445px; display: none; left: 0px; bottom: 3px;">
                                            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 475px; display: none; right: 3px;">
                                            <div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                                <div id="left-bottom">
                                    <table id="totalTable" style="width:100%; float:right; padding:5px; color:#000; background: #FFF;">
                                        <tbody><tr>
                                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Items</td>
                                            <td class="text-right" style="padding: 5px 10px;font-size: 9px; font-weight:bold;border-top: 1px solid #DDD;">
                                                <span id="countItem">0</span> (<span id="titems">0</span>)
                                            </td>
                                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Total</td>
                                            <td class="text-right" style="padding: 5px 10px;font-size: 12px; font-weight:bold;border-top: 1px solid #DDD;">
                                                <span id="total">0.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 5px 10px;">Order Tax
                                                <a href="#" id="pptax2" tabindex="-1">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class="text-right" style="padding: 5px 10px;font-size: 9px; font-weight:bold;">
                                                <span id="ttax2">0.00</span>
                                            </td>
                                            <td style="padding: 5px 10px;">Discount
                                            </td>
                                            <td class="text-right" style="padding: 5px 10px;font-weight:bold;">
                                                <select name="discount_type" class="discount_type">
                                                    <option value="percent" selected >%</option>
                                                    <option value="cash">$</option>
                                                </select>
                                                <input type="text" id="tds" value="0" style="width: 50px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 5px 10px; border-top: 1px solid #666; border-bottom: 1px solid #333; font-weight:bold; background:#333; color:#FFF;" colspan="2">
                                                Total Payable
                                                <span id="tship"></span>
                                            </td>
                                            <td class="text-right" style="padding:5px 10px 5px 10px; font-size: 14px;border-top: 1px solid #666; border-bottom: 1px solid #333; font-weight:bold; background:#333; color:#FFF;" colspan="2">
                                                <span id="gtotal">0.00</span>
                                            </td>
                                        </tr>
                                        </tbody></table>

                                    <div class="clearfix"></div>
                                    <div id="botbuttons" class="col-xs-12 text-center">
                                        <input type="hidden" name="biller" id="biller" value="{{Auth::user()->id}}">
                                        <div class="row">
                                            <div class="col-xs-4" style="padding: 0;">
                                                <div class="btn-group-vertical btn-block">
                                                    <button type="button" class="btn btn-warning btn-block btn-flat" id="suspend" tabindex="-1" style="border-radius: 0px">
                                                        Suspend                                                </button>
                                                    <button type="button" class="btn btn-danger btn-block btn-flat" id="reset" tabindex="-1" style="border-radius: 0px">
                                                        Cancel                                                </button>
                                                </div>

                                            </div>
                                            <div class="col-xs-4" style="padding: 0;">
                                                <div class="btn-group-vertical btn-block">
                                                    <button type="button" class="btn btn-info btn-block" id="print_order" tabindex="-1" style="border-radius: 0px">
                                                        Order                                                </button>

                                                    <button type="button" class="btn btn-primary btn-block" id="print_bill" tabindex="-1" style="border-radius: 0px">
                                                        Bill                                                </button>
                                                </div>
                                            </div>
                                            <div class="col-xs-4" style="padding: 0;">
                                                <button type="button" class="btn btn-success btn-block" id="payment" style="height:61px;border-radius: 0px" tabindex="-1">
                                                    <i class="fa fa-money" style="margin-right: 5px;"></i>Payment                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear:both; height:5px;"></div>
                                    <div id="num">
                                        <div id="icon"></div>
                                    </div>
                                    <span id="hidesuspend"></span>
                                    <input type="hidden" name="pos_note" value="" id="pos_note">
                                    <input type="hidden" name="staff_note" value="" id="staff_note">


                                    <input name="order_tax" type="hidden" value="0" id="postax2">
                                    <input name="total_discount" type="hidden" value="" id="posdiscount">
                                    <input name="grand_total" type="hidden" value="" id="grand_total">
                                    <input name="shipping" type="hidden" value="0" id="posshipping">
                                    <input type="hidden" name="payment_method" id="rpaidby" value="cash" style="display: none;">
                                    <input type="hidden" name="total_items" id="total_items" value="0" style="display: none;">
                                    <input type="submit" id="submit_sale" value="Submit Sale" style="display: none;">
                                </div>
                            </div>

                        </div>
                    </form>
                    <div id="cp" class="hidden-xs">
                        <div id="cpinner">
                            <div class="quick-menu">
                                <div id="proContainer">
                                    <div id="ajaxproducts">
                                        <div id="item-list" style="overflow: scroll; height: 381px; min-height: 515px;">
                                            <div>
                                                <div>
                                                    @foreach($products as $product)
                                                    <button id="product-{{$product->code}}" type="button" value="{{$product->code}}" title="{{$product->name}}" class="btn-prni btn-default product pos-tip" data-container="body">
                                                        @if(Auth::user()->user_role == 1)
                                                        <img src="{{asset('stock/assets/uploads/thumbs/'.$product->image)}}" alt="{{$product->name}}" class="img-rounded">
                                                        @else
                                                            <?php
                                                            $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                                            $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                                            ?>
                                                            <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="{{$product->name}}" class="img-rounded">
                                                        @endif
                                                        <span>{{$product->name}}</span>
                                                    </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-justified pos-grid-nav">
                                            <div class="btn-group">
                                                <button @if($products->currentPage() == 1) disabled="disabled" @else onclick="location.href='{{$products->previousPageUrl()}}'" @endif style="z-index:10002;" class="btn btn-primary pos-tip" title="" type="button" id="previous" data-original-title="Previous" tabindex="-1">
                                                    <i class="fa fa-chevron-left"></i>
                                                </button>
                                            </div>
                                            <div class="btn-group">
                                                <button style="z-index:10003;" class="btn btn-primary pos-tip" type="button" id="sellGiftCard" title="" data-original-title="Sell Gift Card" tabindex="-1">
                                                    <i class="fa fa-credit-card" id="addIcon"></i> Sell Gift Card                                                </button>
                                            </div>
                                            <div class="btn-group">
                                                <button onclick="location.href='{{$products->nextPageUrl()}}'" style="z-index:10004;" class="btn btn-primary pos-tip" title="" type="button" id="next" data-original-title="Next" tabindex="-1">
                                                    <i class="fa fa-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
    <div class="rotate btn-cat-con">
        <button type="button" id="open-brands" class="btn btn-info open-brands" tabindex="-1">Brands</button>
        <button type="button" id="open-subcategory" class="btn btn-warning open-subcategory" tabindex="-1">Sub Categories</button>
        <button type="button" id="open-category" class="btn btn-primary open-category" tabindex="-1">Categories</button>
    </div>
    <div id="brands-slider">
        <div id="brands-list">
            @foreach($brands as $brand)
                <button id="brand-{{$brand->id}}" type="button" value='{{$brand->id}}' class="btn-prni brand" >
                    <img src="{{asset('stock/assets/uploads/'.$brand->image)}}" class='img-rounded img-thumbnail' />
                    <span>{{$brand->name}}</span>
                </button>
            @endforeach
        </div>
    </div>
    <div id="category-slider">
        <button type="button" class="close open-category"><i class="fa fa-2x">&times;</i></button>
        <div id="category-list">
            @foreach($categories as $category)
            <button id="category-{{$category->id}}" type="button" value='{{$category->id}}' class="btn-prni category" >
                <img src="{{asset('stock/assets/uploads/thumbs/'.$category->image)}}" class='img-rounded img-thumbnail' />
                <span>{{$category->name}}</span>
            </button>
            @endforeach
        </div>
    </div>
    <div id="subcategory-slider">
        <!--<button type="button" class="close open-category"><i class="fa fa-2x">&times;</i></button>-->
        <div id="subcategory-list">
            @foreach($subcategories as $sub)
            <button id="subcategory-{{$sub->id}}" type="button" value='{{$sub->id}}' class="btn-prni subcategory" >
                <img src="{{asset('stock/assets/uploads/thumbs/'.$sub->image)}}" class='img-rounded img-thumbnail' />
                <span>{{$sub->name}}</span>
            </button>
            @endforeach
        </div>
    </div>
    <div id="modal-loading" style="display: none;">
        <div class="blackbg"></div>
        <div class="loader"></div>
    </div>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="{{asset('admin-style/pos/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin-style/pos/js/plugins.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin-style/pos/js/parse-track-data.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin-style/pos/js/pos.ajax.js')}}"></script>
    <script type="text/javascript">
        var brand_id = 0, obrand_id = 0, cat_id = 1, ocat_id = 1, sub_cat_id = 0, osub_cat_id,
            count = 1;
        window.onload=function(){
            calculateItem();
            calculateSubtotal();
            calculateTotal();
        }
        $(document).on('click', '.product', function (e) {
            $('#modal-loading').show();
            code = $(this).val(),
                wh = $('#poswarehouse').val(),
                cu = $('#poscustomer').val();
                key = $('#posTable tbody tr').length;
            $.ajax({
                type: "get",
                url: "{{url('pos/getProductDataByCode')}}",
                data: {code: code, warehouse_id: wh, customer_id: cu,key:key},
                dataType: "html",
                success: function (data) {
                    $('#pos-product-sale').prepend(data);
                    calculateItem();
                    calculateSubtotal();
                    calculateTotal();
                }
            });
        });
        $('body').delegate('.remove_item_order','click',function () {
            var $row  = $(this).parents('.item_order').remove();
            var productId = $(this).parents('.item_order').find('.rid').val();
            var status = 'remove';
            var qty = 0;
            calculateItem();
            calculateSubtotal();
            calculateTotal();
            updatePosSaleTmp(productId,status,qty);
            /*if(confirm('You sure to remove this order item ?')){
                var $row  = $(this).parents('.item_order').remove();
                calculateItem();
                calculateSubtotal();
            }*/

        });
        $('body').delegate('#reset','click',function (){
            if(confirm('Are you sure ?')){
                var productId = 0;
                var qty = 0;
                var status = 'cancel';
                updatePosSaleTmp(productId,status,qty);
                window.location.href='{{url('dashboard')}}'
            }
        });
        $('body').delegate('.item_order','keyup',function () {
            var qty=$(this).find('.rquantity').val()-0;
            var price = $(this).find('.rprice').val()-0;
            var subtotal = Number(qty * price).toFixed(2);
            if(qty >0)
            {
                $(this).find('.rquantity').val(qty);
                $(this).find('.subtotal').val(subtotal);//amount
                $(this).find('.ssubtotal').html(subtotal);

                var productId = $(this).find('.rid').val();
                var status = 'update';
                updatePosSaleTmp(productId,status,qty);
                calculateItem();
                calculateSubtotal();
                calculateTotal();
            }
            else
            {
                alert('Enter something.');
            }
        });
        $('body').delegate('#tds','keyup',function (){
            calculateTotal();
        });
        $('body').delegate('.discount_type','change',function (){
            calculateTotal();
        })

        function calculateItem() {
            var item = 0;
            //iterate through each textboxes and add the values
            $(".rquantity").each(function() {

                //add only if the value is number
                /*   if(!isNaN(this.value) && this.value.length!=0) {
                       sum += parseFloat(this.value);
                   }*/

                item += ($(this).val()-0);

            });
            var items = $('#posTable tbody tr').length;
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#titems").html(item.toFixed(2));
            $("#total_items").val(item.toFixed(2));
            $("#countItem").html(items);

        }
        function calculateSubtotal() {

            var subTotal = 0;
            //iterate through each textboxes and add the values
            $(".subtotal").each(function() {

                //add only if the value is number
                /*   if(!isNaN(this.value) && this.value.length!=0) {
                       sum += parseFloat(this.value);
                   }*/

                subTotal += ($(this).val()-0);

            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#total").html(subTotal.toFixed(2));

        }
        function calculateTotal(){
            var discountType = $('.discount_type').val();
            var discount = $('#tds').val()-0;
            var sTotal = $('#total').html()-0;
            if(discountType == 'cash'){
                $('#gtotal').html(Number(sTotal-discount).toFixed(2));
                $('#grand_total').val(Number(sTotal-discount).toFixed(2));
            }else{
                var gTotal = Number(sTotal *(1-discount/100)).toFixed(2);
                $('#gtotal').html(gTotal);
                $('#grand_total').val(gTotal);
            }
            $("#posdiscount").val(discount);
        }
        function updatePosSaleTmp(product_id,status,qty){
            $.ajax({
                type: "get",
                url: "{{url('pos/updatePosSaleTmp')}}",
                data: {id: product_id,status:status,qty:qty},
                dataType: "html",
                success: function (data) {
                    $('#pos-product-sale').prepend(data);
                    calculateItem();
                    calculateSubtotal(0);
                    calculateTotal();
                }
            });
        }

        $('.open-brands').click(function() {
            $('#brands-slider').toggle('slide', { direction: 'right' }, 700);
        });
        $('.open-category').click(function() {
            $('#category-slider').toggle('slide', { direction: 'right' }, 700);
        });
        $('.open-subcategory').click(function() {
            $('#subcategory-slider').toggle('slide', { direction: 'right' }, 700);
        });
        $(document).on('click', function(e) {
            if (
                !$(e.target).is('.open-brands, .cat-child') &&
                !$(e.target)
                    .parents('#brands-slider')
                    .size() &&
                $('#brands-slider').is(':visible')
            ) {
                $('#brands-slider').toggle('slide', { direction: 'right' }, 700);
            }
            if (
                !$(e.target).is('.open-category, .cat-child') &&
                !$(e.target)
                    .parents('#category-slider')
                    .size() &&
                $('#category-slider').is(':visible')
            ) {
                $('#category-slider').toggle('slide', { direction: 'right' }, 700);
            }
            if (
                !$(e.target).is('.open-subcategory, .cat-child') &&
                !$(e.target)
                    .parents('#subcategory-slider')
                    .size() &&
                $('#subcategory-slider').is(':visible')
            ) {
                $('#subcategory-slider').toggle('slide', { direction: 'right' }, 700);
            }
        });
        $('body').delegate('.category', 'click', function () {
            if (cat_id != $(this).val()) {
                $('#open-category').click();
                $('#modal-loading').show();
                cat_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{url('pos/ajaxcategorydata')}}",
                    data: {category_id: cat_id},
                    dataType: "json",
                    success: function (data) {
                        $('#item-list').empty();
                        var newPrs = $('<div></div>');
                        newPrs.html(data.products);
                        newPrs.appendTo("#item-list");
                        $('#subcategory-list').empty();
                        var newScs = $('<div></div>');
                        newScs.html(data.subcategories);
                        newScs.appendTo("#subcategory-list");
                        tcp = data.tcp;

                    }
                }).done(function () {
                    p_page = 'n';
                    $('#category-' + cat_id).addClass('active');
                    $('#category-' + ocat_id).removeClass('active');
                    ocat_id = cat_id;
                    $('#modal-loading').hide();
                    $('#category-slider').css('display','none');
                });
            }
        });
        // $('#category-' + cat_id).addClass('active');

        $('body').delegate('.brand', 'click', function () {
            if (brand_id != $(this).val()) {
                $('#open-brands').click();
                $('#modal-loading').show();
                brand_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{url('pos/ajaxbranddata')}}",
                    data: {brand_id: brand_id},
                    dataType: "json",
                    success: function (data) {
                        $('#item-list').empty();
                        var newPrs = $('<div></div>');
                        newPrs.html(data.products);
                        newPrs.appendTo("#item-list");
                    }
                }).done(function () {
                    p_page = 'n';
                    $('#brand-' + brand_id).addClass('active');
                    $('#brand-' + obrand_id).removeClass('active');
                    obrand_id = brand_id;
                });
            }
        });

        $('body').delegate('.subcategory', 'click', function () {
            if (sub_cat_id != $(this).val()) {
                $('#open-subcategory').click();
                $('#modal-loading').show();
                sub_cat_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{url('pos/ajaxsubcategorydata')}}",
                    data: {subcategory_id: sub_cat_id },
                    dataType: "html",
                    success: function (data) {
                        $('#item-list').empty();
                        var newPrs = $('<div></div>');
                        newPrs.html(data);
                        newPrs.appendTo("#item-list");
                    }
                }).done(function () {
                    p_page = 'n';
                    $('#subcategory-' + sub_cat_id).addClass('active');
                    $('#subcategory-' + osub_cat_id).removeClass('active');
                    $('#modal-loading').hide();
                    setTimeout( "jQuery('#subcategory-slider').hide();",1000 );
                });
            }
        });
    </script>

@endsection
