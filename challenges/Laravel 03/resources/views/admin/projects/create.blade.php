@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/projects/create') ? 'active' : '' }}" href="{{ url('/admin/projects/create') }}">Додај</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/projects') && !request()->is('admin/projects/create') ? 'active' : '' }}" href="{{ url('/admin/projects') }}">Измени</a>
        </li>
    </ul>
</div>

<div class="container py-4">
    <h4 class="mb-4">Додај нов производ:</h4>

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
            <form action="/admin/projects" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Име</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label>Поднаслов</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}" required>
                </div>

                <div class="mb-3">
                    <label>Слика</label>
                    <input type="url" name="image" class="form-control" value="{{ old('image') }}" 
                           placeholder="http://" required>
                </div>

                <div class="mb-3">
                    <label>URL</label>
                    <input type="url" name="url" class="form-control" value="{{ old('url') }}" 
                           placeholder="http://" required>
                </div>

                <div class="mb-3">
                    <label>Опис</label>
                    <textarea name="description" class="form-control" rows="3" maxlength="200" 
                              required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning">Додај</button>
            </form>
        </div>
    </div>
</div>
@endsection