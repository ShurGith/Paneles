<?php

    use Illuminate\Support\Facades\Route;


    Route::get('/', function () {
        return redirect('/admin');
    })->middleware(['auth', 'verified'])->name('dashboard');
