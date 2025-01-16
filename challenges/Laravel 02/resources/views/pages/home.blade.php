@extends('layouts.app')

@section('title', 'Home')

@section('header')
    @include('partials._header', [
        'bgImage' => asset('img/home-bg.jpg'),
        'title' => $title,
        'subtitle' => $subtitle
    ])
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">
            <a href="{{ route('blog') }}">
                <h2>Man must explore, and this is exploration at its greatest</h2>
                <h3 class="post-subtitle">Problems look mighty small from 150 miles up</h3>
            </a>
            <p class="post-meta">Posted by Start Bootstrap on August 24, 2018</p>
        </div>
        <hr>

        <div class="post-preview">
            <a href="{{ route('blog') }}">
                <h2>Lorem Ipsum 2</h2>
                <h3 class="post-subtitle">Another boring meta text</h3>
            </a>
            <p class="post-meta">Posted by John Doe in another boring meta</p>
        </div>
        <hr>

        <div class="post-preview">
            <a href="{{ route('blog') }}">
                <h2>Lorem Ipsum 3</h2>
                <h3 class="post-subtitle">Veniam amet ad laborum excepteur ullamco consequat in adipisicing Lorem cillum excepteur.</h3>
            </a>
            <p class="post-meta">Posted by Jane Doe</p>
        </div>
        <hr>

        <div class="post-preview">
            <a href="{{ route('blog') }}">
                <h2>Lorem Ipsum 4</h2>
                <h3 class="post-subtitle">Mollit aute dolore proident consectetur exercitation ex.</h3>
            </a>
            <p class="post-meta">Posted by Missy Doe</p>
        </div>
        
        <!-- Pager -->
        <div class="clearfix">
            <a class="btn btn-primary float-end" href="#">Older posts →</a>
        </div>
    </div>
</div>
@endsection