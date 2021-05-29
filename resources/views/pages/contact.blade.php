@extends('layouts.app')
@section('content')
    <div class="container white-bg" id="contact-page">
        <div class="bg">
            {{--<div class="row">--}}
                {{--<div class="col-sm-12">--}}
                    {{--<h2 class="title text-center">Contact <strong>Us</strong></h2>--}}
                    {{--<div class="contact-map" id="gmap">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        <div style="display: none" class="status alert alert-success"></div>
                        <form method="post" name="contact-form" class="contact-form row" id="main-contact-form">
                            <div class="form-group col-md-6">
                                <input type="text" placeholder="Name" required="required" class="form-control" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" placeholder="Email" required="required" class="form-control" name="email">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" placeholder="Subject" required="required" class="form-control" name="subject">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea placeholder="Your Message Here" rows="8" class="form-control" required="required" id="message" name="message"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" value="Submit" class="btn btn-primary pull-right" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>ECammall Online Site.</p>
                            <p>Toul kok</p>
                            <p>Phnom Penh Cambodia</p>
                            <p>Mobile: 016 66 33 79</p>
                            <p>Email: info@ecammall.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection