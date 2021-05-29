<div class="text-center">
<img src="{{asset('stock/assets/uploads/'.$product->image)}}" class="rounded" style="width: 400px;height: 400px" alt="{{$product->name}}">
</div>

<script>
    $('#productImageModalLabel').text('{{$product->name }}')
</script>
