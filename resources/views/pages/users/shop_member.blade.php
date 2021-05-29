<?php
$_firstName = isset($q['first_name'])?($q['first_name']):null;
$_email = isset($q['email'])?($q['email']):null;
?>
@extends('layouts.app')
@section('title','My Account')
@section('my_account','active')
@section('my_customer_order','active')
@section('content')
    <div class="container">
        <div class="row white-bg">
            @include('pages.users.my_ecammall_menu_sell')
            <div class="col-sm-9 padding-right">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    My Account
                </h2>
                <div class="col-lg-9">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{url('em-user/'.$userId.'/create_shop_member')}}"> Create Member</a>
                    </div>
                    <br><br>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> No</th>
                                <th> Name </th>
                                <th> Email</th>
                                <th> User Role</th>
                                {{--<th> Product Cost</th>--}}
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key=>$user)
                                <tr class="even gradeC">
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->first_name.' '.$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if(!empty($user->roles))
                                            @foreach($user->roles as $v)
                                                <label class="label label-success">{{ $v->display_name }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    {{--<td>{{$category->cost}}</td>--}}
                                    <td class="center">

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection