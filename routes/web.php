<?php

declare(strict_types=1);

use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsFavoritesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home
Route::get('/', function () {
    return Inertia::render('Welcome');
//    return Inertia::render('Posts/Index');
})->name('home');

// Posts
Route::controller(PostController::class)->group(function () {
    Route::get('/posts', function () {
        return Inertia::render('Posts/Index');
    })->name('posts.index');
});

// News
Route::resource('news', NewsController::class);

// News Favorites
Route::post('/news/{newsItem}/favorite', [NewsFavoritesController::class, 'toggleFavorite'])
    ->middleware('auth');

// About
Route::get('about', function () {
    return Inertia::render('About');
})->name('about');

// Contact
Route::get('contact', function () {
    return Inertia::render('Contact');
})->name('contact');

// 404, Monty Python style :)
Route::fallback(function () {
    $message = Arr::random([
        'This parrot is no more.',
        'It has ceased to be.',
        'It\'s expired and gone to meet its maker.',
        'This is a late parrot.' ,
        'It\'s stiff.',
        'Bereft of life, it rests in peace.',
        'It\'s rung down the curtain and joined the choir, invisible.',
        'This is an ex-parrot.'
    ]);
    return response()->view('errors.404', [
        'message' => $message,
    ], 404);
});

// Admin: Dashboard
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin: Favorites
Route::prefix('favorites')->name('favorites.')->group(function () {
    Route::get('/', [NewsFavoritesController::class, 'index'])->name('index');
    Route::post('{newsItem}/toggle-read', [NewsFavoritesController::class, 'toggleRead'])->name('toggle-read');
    Route::post('{newsItem}/archive', [NewsFavoritesController::class, 'archive'])->name('archive');
})->middleware(['auth', 'verified']);

// Admin: Posts
Route::resource('admin-posts', AdminPostController::class);
Route::get('admin-posts/{postId}/toggle-published', [AdminPostController::class, 'togglePublished'])->name('admin-posts.toggle-published');
Route::get('admin-posts/{postId}/toggle-featured', [AdminPostController::class, 'toggleFeatured'])->name('admin-posts.toggle-featured');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
