<?php
$base_url = 'http://ecammall.com/';
?>
@foreach($products as $product)
<?php
$firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
$imageName = isset($firstImage->image)?$firstImage->image:$product->image;
?>
<div class="col-md-3 col-sm-4 col-xs-6 padding-5px products" data-price = "{{$product->price}}" data-name = "{{$product->name}}">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                @if(\Request::is('shop/*'))
                    <a href="{{url('shop/product_detail/'.$product->id)}}">
                        <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" class="img-responsive"/>
                    </a>
                    <p class="text-height">{{substr($product->name,0,40)}}</p>
                    <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                    {{--<a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                @else
                    <a href="{{url('product_detail/'.$product->id)}}">
                        <img alt="" src="{{$base_url}}stock/assets/uploads/{{$product->image}}" class="img-responsive">
                    </a>
                    <p class="text-height">{{substr($product->name,0,40)}}</p>
                    <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                    {{--<a href="{{url('product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                @endif
            </div>
        </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <?php
                if(Auth::check()){
                    $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                }
                ?>
                @if(\Request::is('shop/*'))
                    <input type="hidden" name="product_from" value="0" class="product_from">
                @else
                    <input type="hidden" name="product_from" value="1" class="product_from">
                @endif
                <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                <li>
                    <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                @if(Auth::check() and $wishList)
                    <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                @else
                    <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                    </li>
                @endif
                @if(\Request::is('shop/*'))
                    <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                @else
                    <li><a href="{{url('product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endforeach


