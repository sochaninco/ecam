<?php
$width = ($width>0?($width):'70');
$height = ($height>0?($height):'50');
?>
<!DOCTYPE html>
<html>
<head>
    <title>EcamMall | Print Label</title>
<style>
    @page {
        size: 9.25in 7in;
        margin: 5mm 5mm 5mm 5mm;
    }
    p{
        /*font-family: "Khmer OS Bokor";*/
        margin: 0px;
        /*padding: 10px;*/
        font-size: 14px;
    }
    .content{
        width: {{$width}}mm;
        height: {{$height}}mm;
        background-color: #ffffff;
        border: #00cc66 1px solid;
        margin: 2px;
        display: inline-table;
        position: relative;
    }
    .product-name{
        font-family: Arial, Verdana, sans-serif;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 14px;
        padding: 10px;
    }
    .product-detail{
        font-family: "Khmer OS Bokor";
        text-transform: capitalize;
        font-size: 12px;
        padding: 0px 10px;
        position: absolute;
    }
    .image-small{
        bottom: 33px;
        position: absolute;
        right: 1px;
        height: 71px;
    }
    .image-small img{
        width: 70px;
        height: 70px;
    }
    .product-price{
        background-color: #1fad83;
        bottom: 0px;
        width: {{$width}}mm;
        position: absolute;
        padding: 3px 0px 2px 0px;
        font-weight: 600;

    }
    .price-kh{
        width: 35mm;
        display: inline;
        padding-left: 10px;
        font-family: "Khmer OS Bokor" ;
        font-size: 12px;
    }
    .price-us{
        float: right;
        display: inline;
        text-align: right;
        padding-right: 10px;
        padding-top: 5px;

    }
</style>

</head>
<body onload="window.print()">
    @foreach($products as $product)
        <?php
            $price = number_format($product->price,2);
            $priceKh = number_format($price*4000,0);
        ?>

        <div class="content">
            <p class="product-name">{{$product->name}}</p>
            <div class="product-detail">{!! $product->details !!} </div>
            @if($image == true)
            <div class="image-small">
                <img src="{{asset('http://ecammall.com/stock/assets/uploads/'.$product->image)}}" class="img-responsive">
            </div>
            @endif
            <div class="product-price">
                <p class="price-kh">{{$priceKh}} រៀល</p>
                <p class="price-us">{{$price}} USD</p>
            </div>
        </div>
    @endforeach
</body>
</html>