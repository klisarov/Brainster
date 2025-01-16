@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Измени постоечки производ:</h4>

    @if($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="/admin/projects/{{ $project->id }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label>Име</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ old('name', $project->name) }}" required>
                </div>

                <div class="mb-3">
                    <label>Поднаслов</label>
                    <input type="text" name="subtitle" class="form-control" 
                           value="{{ old('subtitle', $project->subtitle) }}" required>
                </div>

                <div class="mb-3">
                    <label>Слика</label>
                    <input type="url" name="image" class="form-control" 
                           value="{{ old('image', $project->image) }}" required>
                </div>

                <div class="mb-3">
                    <label>URL</label>
                    <input type="url" name="url" class="form-control" 
                           value="{{ old('url', $project->url) }}" required>
                </div>

                <div class="mb-3">
                    <label>Опис</label>
                    <textarea name="description" class="form-control" rows="3" maxlength="200" 
                              required>{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">Зачувај</button>
                    <a href="/admin/projects" class="btn btn-secondary">Откажи</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection