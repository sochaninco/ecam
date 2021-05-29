@extends('layouts.app')
@section('content')
    <div class="container white-bg" id="contact-page">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-post-area">
                        <h2 class="title text-center">{{$footers->name}}</h2>
                        <div class="single-blog-post">
                            <h3>{{$footers->name}}</h3>
                            <p>
                                {!! $footers->description !!}
                            </p> <br>
                        </div>
                    </div><!--/blog-post-area-->
                    <img src="{{asset('images/footer/'.$footers->image)}}" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
@endsection