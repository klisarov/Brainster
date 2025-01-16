@extends('layouts.app')

@section('title', 'Blog Post')

@section('header')
    @include('partials._header', [
        'bgImage' => asset('img/post-bg.jpg'),
        'title' => $title,
        'subtitle' => $subtitle,
        'posted_by' => $posted_by,
        'posted_on' => $posted_on
    ])
@endsection

@section('content')
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet.</p>

                <h2 class="section-heading">The Final Frontier</h2>

                <p>There can be no thought of finishing for 'aiming for the stars.' Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p>

                <h2 class="section-heading">Reaching for the stars</h2>

                <p>As we got further and further away, it [the Earth] diminished in size. Finally it shrank to the size of a marble, the most beautiful you can imagine.</p>

                <img class="img-fluid" src="{{ asset('img/blog-image.jpg') }}" alt="Space">
            </div>
        </div>
    </div>
</article>
@endsection