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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Измени постоечки производи:</h4>
    </div>

    <div class="row g-4">
        @foreach($projects as $project)
        <div class="col-md-4">
            <div class="project-card admin-card card h-100 position-relative">
                @if(session('editing') == $project->id)
                    <form action="{{ url('/admin/projects/'.$project->id) }}" method="POST" class="card-edit-form">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" class="form-control" value="{{ $project->name }}" placeholder="Име" required>
                        <input type="text" name="subtitle" class="form-control" value="{{ $project->subtitle }}" placeholder="Поднаслов" required>
                        <input type="url" name="image" class="form-control" value="{{ $project->image }}" placeholder="Слика URL" required>
                        <input type="url" name="url" class="form-control" value="{{ $project->url }}" placeholder="URL" required>
                        <textarea name="description" class="form-control" rows="3" required>{{ $project->description }}</textarea>
                        <div class="button-group">
                            <button type="submit" class="btn btn-warning">Зачувај</button>
                            <a href="{{ url('/admin/projects') }}" class="btn btn-secondary">Откажи</a>
                        </div>
                    </form>
                @else
                    <img src="{{ $project->image }}" class="card-img-top" alt="{{ $project->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->name }}</h5>
                        <h6 class="card-subtitle">{{ $project->subtitle }}</h6>
                        <p class="card-text">{{ $project->description }}</p>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ url('/admin/projects/'.$project->id.'/edit') }}" class="btn btn-warning btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-delete" onclick="confirmDelete({{ $project->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Избриши</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Дали сте сигурни дека сакате да го избришете производот?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Откажи</button>
                    <button type="submit" class="btn btn-warning">Избриши</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<script>
function confirmDelete(id) {
    document.getElementById('deleteForm').action = '/admin/projects/' + id;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection