<div class="register-req">
    <p> Please fill your payment information</p>
</div><!--/register-req-->
<div class="shopper-informations">
    <div class="row">
        <div class="col-sm-12">
            <div class="shopper-info">
                {!! Form::Open(['url'=>'orders/'.$order_id.'/submit_payment','method'=>'POST','files'=>true]) !!}

                @if($method->id == 6)
                    <input type="text" value="" placeholder="Payer Name" name="name">
                    <input type="text" value="" placeholder="Payer Phone Number" name="sender_phone">
                    <input type="text" value="" placeholder="Wing Code" name="wing_code">
                @else
                    <input type="text" value="" placeholder="Bank Name" name="bank_name">
                    <input type="text" value="" placeholder="Account Name" name="account_name">
                    <input type="text" value="" placeholder="Account Number" name="account_number">
                @endif
                <input type="hidden" name="payment_method" value="{{$method->id}}">
                <input type="submit" class="btn btn-primary" value="Submit" name="Submit">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>