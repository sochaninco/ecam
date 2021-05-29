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
