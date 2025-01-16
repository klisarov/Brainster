@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        Невалидни податоци
                    </div>
                    @endif

                    <form method="POST" action="/login">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Логирај се</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
