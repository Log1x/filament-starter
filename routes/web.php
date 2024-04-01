<?php

use App\Livewire\Home;
use App\Livewire\Post\Show as PostShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');
