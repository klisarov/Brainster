@extends('layouts.app')

@section('content')
<div class="hero">
    <div class="container">
        <h1>Brainster.xyz Labs</h1>
        <p>Проекти од академиите на Brainster</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        @foreach($projects as $project)
        <div class="col-md-4">
            <div class="project-card card">
                <img src="{{ $project->image }}" class="card-img-top" alt="{{ $project->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->name }}</h5>
                    <h6 class="card-subtitle">{{ $project->subtitle }}</h6>
                    <p class="card-text">{{ $project->description }}</p>
                    <a href="{{ $project->url }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
