<div class="payment-options white-bg">
    <?php
    $paymentMethods = \App\PaymentMethod::where('status',0)->get();
    ?>
    <span>
        <label>
            <input type="radio" value="0" name="payment_method" checked> COD (Cash On Delivery)
        </label>
    </span>
    @foreach($paymentMethods as $method)
        <span>
            <label>
                <input type="radio" value="{{$method->id}}" name="payment_method">@if(!empty($method->logo))
                    <img src="{{asset('images/payment/'.$method->logo)}}">
                @endif {{$method->name}}
            </label>
        </span>
    @endforeach
</div>