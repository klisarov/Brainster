@extends('layouts.app')

@section('title', 'Contact')

@section('header')
    @include('partials._header', [
        'bgImage' => asset('img/contact-bg.jpg'),
        'title' => $title,
        'subtitle' => $subtitle
    ])
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="my-5">
            <div class="floating-label-form-group">
                <input class="form-control" type="text" placeholder="Name" readonly>
            </div>
            
            <div class="floating-label-form-group">
                <input class="form-control" type="email" placeholder="Email Address" readonly>
            </div>
            
            <div class="floating-label-form-group">
                <input class="form-control" type="tel" placeholder="Phone Number" readonly>
            </div>
            
            <div class="floating-label-form-group">
                <textarea class="form-control" rows="5" placeholder="Message" readonly></textarea>
            </div>
            
            <button class="btn btn-primary text-uppercase" type="submit">Send</button>
        </div>
    </div>
</div>
@endsection