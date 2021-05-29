@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Page Management</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    page manage
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @foreach($pageManagement as $key=>$page)
                                <div class="form-group col-sm-12">
                                    @if($page->id ==1)
                                        {!! Form::label('block','Show Product by category on home page',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 2)
                                        {!! Form::label('block','Show Product by City&Brand on footer page',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 3)
                                        {!! Form::label('block','Show Recomment item on home page',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 4)
                                        {!! Form::label('block','Show Menu header top',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 5)
                                        {!! Form::label('block','Show Latest product on Homepage',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 6)
                                        {!! Form::label('block','Show Flash deal on Homepage',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 7)
                                        {!! Form::label('block','Show Ecammall Category on Homepage',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 8)
                                        {!! Form::label('block','Show Special Offer on Homepage',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 9)
                                        {!! Form::label('block','Show Featured Item on Homepage',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 10)
                                        {!! Form::label('block','Show SubCategory List on Homepage',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 11)
                                        {!! Form::label('block','Show You May Also Like on Mobile',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 12)
                                        {!! Form::label('block','Show Flash deal on Homepage Of Mobile',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 13)
                                        {!! Form::label('block','Show Ecammall Category on Homepage Of Mobile',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 14)
                                        {!! Form::label('block','Show Ecammall Slide Homepage',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 15)
                                        {!! Form::label('block','Show Ecammall Banner Top Homepage',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 16)
                                        {!! Form::label('block','Show Ecammall Category on Homepage Style small banner For Mobile',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 17)
                                        {!! Form::label('block','Show Ecammall Category on Homepage Style small left',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 18)
                                        {!! Form::label('block','Show Ecammall Category on Homepage Style small right',['class'=>'control-label col-sm-6']) !!}
                                    @elseif($page->id == 19)
                                        {!! Form::label('block','Show Online Exhibition',['class'=>'control-label col-sm-6']) !!}
                                    @endif
                                    <div class="col-sm-4">
                                        <div class="col-sm-6">
                                            <input type="radio" value="1" name="{{$page->block}}" class="{{$page->block}}" @if($page->status == 1) checked @endif> Hidden
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="radio" value="0" name="{{$page->block}}" class="{{$page->block}}" @if($page->status == 0) checked @endif> Display
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection