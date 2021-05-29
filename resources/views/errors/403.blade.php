{{-- extend Layout --}}
@extends('layouts.app')

{{-- page title --}}
@section('title','Access Denied')

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-404.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <section>
        <div class="container">
            <div align="center" class="row white-bg">
                <h3 class="error-code m-0">You don't have permission</h3>
                <h6 class="mb-2">BAD REQUEST</h6>
                <img src="{{asset('images/404/RequestAccess.png')}}" class="img-responsive">
                <a class="btn waves-effect waves-light gradient-45deg-deep-purple-blue gradient-shadow mb-4"
                   href="{{url('/')}}">Back To Home</a>
            </div>
        </div>
    </section>

@endsection
