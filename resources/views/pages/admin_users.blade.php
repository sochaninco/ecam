<?php
$_firstName = isset($q['first_name'])?($q['first_name']):null;
$_email = isset($q['email'])?($q['email']):null;
?>
@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Listing</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('admin/create_user') }}"> Create New User</a>
            </div>
        </div>
        <div class="col-lg-12">
            {{--<a href="{{url('add_footer_page')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Footer Page</a>--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your User
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    {!! Form::open(['method'=>'GET','files'=>true,'role'=>'form']) !!}
                    <div class="form-group">
                        {!! Form::label('name','User Name',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('first_name',$_firstName,['class'=>'form-control','placeholder'=>'Enter Name..']) !!}
                        </div>
                        {!! Form::label('email','User Email',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('email',$_email,['class'=>'form-control','placeholder'=>'Enter Email..']) !!}
                        </div>
                        <div class="col-sm-2">
                            {!! Form::submit('Search',['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <br><br><br>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> No</th>
                                <th> Name </th>
                                <th> Email</th>
                                <th> Shop Name</th>
                                <th> User Role</th>
                                {{--<th> Product Cost</th>--}}
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key=>$user)
                                <?php
                                $checkShop = \App\PageShops::where('user_id',$user->id)->first();
                                ?>
                            <tr class="even gradeC">
                                <td>{{++$i}}</td>
                                <td>@if($checkShop)<a href="{{route('shop.index',$user->id)}}" target="_blank"> {{$user->first_name.' '.$user->last_name}}</a>@else {{$user->first_name.' '.$user->last_name}} @endif </td>
                                <td>{{$user->email}}</td>
                                <td>
                                @if($checkShop)
                                    {{$checkShop->shop_name}}
                                @endif
                                </td>
                                <td>
                                    @if(!empty($user->roles))
                                        @foreach($user->roles as $v)
                                            <label class="label label-success">{{ $v->display_name }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                {{--<td>{{$category->cost}}</td>--}}
                                <td class="center">
                                    <a href="{{url('admin/edit_user/'.$user->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                    </a>
                                    @if($user->activated == 1)
                                        <a href="{{url('admin/delete_user/'.$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user ?');"><i class="fa fa-times"></i>
                                        </a>
                                        @if($checkShop)
                                            <a href="{{url('admin/user_shop/'.$user->id)}}" class="btn btn-info" title="Go to Shop"><i class="fa fa-link"></i> </a>
                                        @else
                                            <a href="{{url('admin/create_user_shop/'.$user->id)}}" class="btn btn-success" title="Create Shop for User"><i class="fa fa-building"></i> </a>
                                        @endif
                                    @else
                                        <a href="{{url('admin/enable_user/'.$user->id)}}" class="btn btn-info" onclick="return confirm('Are you sure you want to enable this user ?');"><i class="fa fa-check"></i>
                                        </a>
                                        {{--<a href="{{url('admin/activate_user/'.$user->id)}}" class="btn btn-success" onclick="return confirm('Are you sure you want to activate this user ?');"><i class="fa fa-check"></i>--}}
                                        {{--</a>--}}
                                    @endif
                                    <a href="{{url('admin/hard_delete_user/'.$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user from system');"><i class="fa fa-trash-o"></i> </a>
                                    {{--<button type="button" class="btn btn-danger"><i class="fa fa-times"></i>--}}
                                    {{--</button>--}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $users->render() !!}
                    </div>
                    <!-- /.table-responsive -->
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