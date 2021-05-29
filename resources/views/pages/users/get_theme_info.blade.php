<div class="form-group theme_info">
    {!! Form::label('shop_theme_info','Theme Info',['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        <table class="table table-responsive table-responsive table-striped">
            <tr>
                <td>Banner</td>
                <td>Banner Small</td>
            </tr>
            <tr>
                <td><img src="{{asset('images/theme-shop/'.$theme->theme_banner)}}" class="img-responsive"></td>
                <td><img src="{{asset('images/theme-shop/'.$theme->theme_banner_small)}}" class="img-responsive"> </td>
            </tr>
        </table>
    </div>
</div>