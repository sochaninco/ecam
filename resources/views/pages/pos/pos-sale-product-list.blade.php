<tr id="row_{{$product->code}}" class="row_{{$product->code}} item_order sname" data-item-id="{{$product->code}}">
    <td>
        <input name="item[{{$key}}][product_id]" type="hidden" class="rid" value="{{$product->id}}">
        <input name="item[{{$key}}][product_type]" type="hidden" class="rtype" value="standard">
        <input name="item[{{$key}}][product_code]" type="hidden" class="rcode" value="{{$product->code}}">
        <input name="item[{{$key}}][product_name]" type="hidden" class="rname" value="{{$product->name}}">
        <input name="item[{{$key}}][product_option]" type="hidden" class="roption" value="769">
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
        <input class="realuprice" name="item[{{$key}}][real_unit_price]" type="hidden" value="{{$product->price}} - {{$product->cost}}">
        <span class="text-right sprice" id="sprice_{{$product->price}}">{{number_format($product->price,2)}}</span>
    </td>
    <td>
        <input class="form-control text-center rquantity" tabindex="2" name="item[{{$key}}][quantity]" type="text" value="1" data-id="{{$product->code}}" data-item="{{$product->code}}" id="quantity_{{$product->code}}" onclick="this.select();" role="textbox">
        <input name="item[{{$key}}][product_unit]" type="hidden" class="runit" value="{{$product->unit}}">
        <input name="item[{{$key}}][product_base_quantity]" type="hidden" class="rbase_quantity" value="{{$product->quantity}}">
    </td>
    <td class="text-right">
        <input type="hidden" class="subtotal" value="{{$product->price}}">
        <span class="text-right ssubtotal" id="subtotal_{{$product->code}}">{{number_format($product->price,2)}}</span>
    </td>
    <td class="text-center">
        <i class="fa fa-times tip pointer remove_item_order" id="{{$product->code}}" title="Remove" style="cursor:pointer;"></i>
    </td>
</tr>
