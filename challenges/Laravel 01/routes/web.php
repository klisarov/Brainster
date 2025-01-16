<?php

    use App\Http\Controllers\UserController;

    Route::get('/', [UserController::class, 'home'])->name('home');
    Route::get('/form', [UserController::class, 'showForm'])->name('form');
    Route::post('/submit-form', [UserController::class, 'submitForm'])->name('submit.form');
    Route::get('/info', [UserController::class, 'info'])->name('info');
    Route::post('/clear-session', [UserController::class, 'clearSession'])->name('clear.session');

    
?>