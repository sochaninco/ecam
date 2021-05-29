<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="container-fluid px-sm-1 py-5 mx-auto">
            <div class="row justify-content-center">
                <div class="d-flex">
                    <div class="card">
                        <div class="d-flex flex-column thumbnails">
                            @foreach($productImages as $key=>$image)
                            <div id="{{$image->id}}" class="tb @if($key == 0) tb-active @endif">
                                <img class="thumbnail-img fit-image" src="{{asset('stock/assets/uploads/thumbs/'.$image->photo)}}">
                            </div>
                            @endforeach
                        </div>
                        @foreach($productImages as $key=>$image)
                        <fieldset id="{{$image->id}}1" class="@if($key == 0) active @endif">
                            <div class="product-pic"> <img class="pic0" src="{{asset('stock/assets/uploads/'.$image->photo)}}"> </div>
                        </fieldset>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-md-6">
        <table class="table table-striped">
            <tr>
                <td>Name : </td>
                <td>{{$productPopUp->name}}</td>
            </tr>
            <tr>
                <td>Code : </td>
                <td>{{$productPopUp->code}}</td>
            </tr>
            <tr>
                <td>Brand : </td>
                <td>
                    @if(!empty($productPopUp->brand))
                        {{$brand[$productPopUp->brand]}}</td>
                @endif
            </tr>
            <tr>
                <td>Category : </td>
                <td>{{$productPopUp->c_name}}</td>
            </tr>
            <tr>
                <td>SubCategory : </td>
                <td>@if($productPopUp->subcategory_id != 0)
                        {{$subCategory[$productPopUp->subcategory_id]}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Unit : </td>
                <td>@if($productPopUp->unit != 0){{$unit[$productPopUp->unit]}}@endif</td>
            </tr>
            <tr>
                <td>Cost : </td>
                <td>{{$productPopUp->cost}}</td>
            </tr>
            <tr>
                <td>Price : </td>
                <td>$ {{$productPopUp->price}}</td>
            </tr>
            <tr>
                <td> Alert Quantity</td>
                <td>{{$productPopUp->alert_quantity}}</td>
            </tr>
            <tr>
                <td>
                    Product Variants
                </td>
                <td>
                    @if(count($productVariants) > 0)
                        @foreach($productVariants as $variant)
                            <p class="btn btn-info btn-xs">{{$variant->name}}</p>
                        @endforeach
                    @endif
                </td>
            </tr>
        </table>
    </div>

</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <span>Custom field</span>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Custom Field</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Custom Field 1</td>
                <td>{{$productPopUp->cf1}}</td>
            </tr>
            <tr>
                <td>Custom Field 2</td>
                <td>{{$productPopUp->cf2}}</td>
            </tr>
            <tr>
                <td>Custom Field 3</td>
                <td>{{$productPopUp->cf3}}</td>
            </tr>
            <tr>
                <td>Custom Field 4</td>
                <td>{{$productPopUp->cf4}}</td>
            </tr>
            <tr>
                <td>Custom Field 5</td>
                <td>{{$productPopUp->cf5}}</td>
            </tr>
            <tr>
                <td>Custom Field 6</td>
                <td>{{$productPopUp->cf6}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6 col-md-6">
        <span>Warehouse Quantity of Product Variants</span>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>warehouse name</th>
                <th>product variant</th>
                <th>quantity</th>
                <th>price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($warehouseProductVariants as $warehouseProduct)
            <tr>
                <td>{{$warehouse[$warehouseProduct->warehouse_id]}}</td>
                <td>{{$warehouseProduct->name}}</td>
                <td>{{$warehouseProduct->quantity}}</td>
                <td>{{$warehouseProduct->price}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-6 col-md-6">
        <span>Warehouse Quantity</span>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Warehouse Name</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($warehouseQuantity as $wQuantity)
            <tr>
                <td>{{$warehouse[$wQuantity->warehouse_id]}}</td>
                <td>{{$wQuantity->quantity}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script>
    $('#productDetailModalLabel').text('{{$productPopUp->name }}')
    $(document).ready(function(){

        $(".tb").hover(function(){

            $(".tb").removeClass("tb-active");
            $(this).addClass("tb-active");

            current_fs = $(".active");

            next_fs = $(this).attr('id');
            next_fs = "#" + next_fs + "1";

            $("fieldset").removeClass("active");
            $(next_fs).addClass("active");

            current_fs.animate({}, {
                step: function() {
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        });

    });
</script>
