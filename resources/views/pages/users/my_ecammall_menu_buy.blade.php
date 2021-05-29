<?php
$checkParent = \App\User::where('id',Auth::user()->id)->first();

if($checkParent->parent_id != 0){
    $userId = $checkParent->parent_id;
}elseif ($checkParent->user_role == 1){
    $userId = $userId;
}
else{
    $userId = $checkParent->id;
}
$ShopInfo = \App\PageShops::where('user_id',$userId)->first();
?>        
<div class="col-sm-3 hidden-xs">
    <div class="left-sidebar">
        <h2>ShortCuts</h2>
        <div class="category-tab hidden-xs"><!--category-tab-->
            <div class="col-sm-12 no-padding">
                <ul class="nav nav-tabs">
                    <li class="@yield('my_personal_order')-tab" style="width: 50%;font-weight: bold"><a href="{{url('em-user/'.$userId.'/my_orders')}}">Buy</a></li>
                    <li class="@yield('my_customer_order')-tab" style="width: 50%;font-weight: bold;"><a href="@if($ShopInfo) {{url('em-user/'.$userId.'/customer_orders')}} @else {{url('em-user/'.$userId.'/new_shop')}} @endif">@if($ShopInfo) Sell @else Create Shop @endif</a></li>
                </ul>
            </div>
        </div>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                <div class="panel panel-default">
                    <div class="panel-heading @yield('my_personal_order')-tab">
                        <h4 class="panel-title"><a href="{{url('em-user/'.$userId.'/my_orders')}}">My Orders</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading @yield('my_personal_order')-tab">
                        <h4 class="panel-title"><a href="{{url('#')}}">Member Center</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading @yield('my_personal_order')-tab">
                        <h4 class="panel-title"><a href="{{url('#')}}">Recently Viewed Products</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading @yield('my_personal_order')-tab">
                        <h4 class="panel-title"><a href="{{url('em-user/'.$userId.'/my_account')}}">Change Password</a></h4>
                    </div>
                </div>
        </div>

        <h2>My WishList</h2>

        <div class="shipping list-item-pro-detail">
            <?php
            $myWishLists = \App\WishList::where('user_id',$userId)->get();
            ?>
            @foreach($myWishLists as $key=>$wish)
                <?php
                $base_url = 'http://ecammall.com/';
                //                        $imageName = isset($firstImage->photo)?$firstImage->photo:$product->image;

                if($wish->product_from == 1){
                    $product = \App\Product::where('id',$wish->product_id)->first();
                    if($product){
                        $imageLink = $base_url.'stock/assets/uploads/'.$product->image;
                        $link = $base_url.'product_detail/'.$product->id;
                    }
                }else{
                    $product =\App\ShopProduct::where('id',$wish->product_id)->first();
                    if($product){
                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                        $imageLink = asset('images/thumbnails/large/'.$imageName);
                        $link = $base_url.'shop/product_detail/'.$product->id;
                    }
                }
                ?>
                @if($product)
                <div class="padding-top-10px">
                    <div class="col-sm-4 padding-5px">
                        <a href="{{$link}}"><img alt="" src="{{$imageLink}}" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-8">
                        <p>{{substr($product->name,0,20)}}</p>
                        <p> Price : $ {{sprintf('%0.2f', $product->price)}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>