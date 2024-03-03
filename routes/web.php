<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Components\CreatePost;
use App\Livewire\Components\ShowPost;
use App\Livewire\Peoples;
use App\Livewire\Profile;
use App\Livewire\ProfileEdit;
use App\Livewire\CreateChannel;
use App\Livewire\Channel;
use App\Livewire\Channels;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified', 'VerifiedUser'])->group(function () {
    Route::get('/', Home::class)->name('home');

    Route::get('/profile/{user:username}', Profile::class)->name('profile.show');
    Route::get('/profile/{user:username}/edit', ProfileEdit::class)->name('profile-edit');
    Route::post('/profile.edit', [ProfileEdit::class, 'profileEdit'])->name('profile.edit');

    Route::get('/create-post', CreatePost::class)->name('create-post');
    Route::post('/createpost', [CreatePost::class, 'createpost'])->name('createpost');

    Route::get('/post/{post:uuid}', ShowPost::class)->name('post.show');
    Route::get('/post/{post:id}/like', [Home::class, 'like'])->name('post.like');
    Route::get('/post/{post:id}/dislike', [Home::class, 'dislike'])->name('post.dislike');
    Route::post('/post/{post:id}/comment', [ShowPost::class, 'saveComment'])->name('post.comment');
    Route::get('/post/{post:uuid}/delete', [ShowPost::class, 'deletePost'])->name('post.delete');

    Route::get('/post/{post:id}/edit', [ShowPost::class, 'editPost'])->name('post.edit');


    Route::get('/friends', Peoples::class)->name('friends');
    Route::get('/add-friend/{user:id}', [Peoples::class, 'addFriend'])->name('add-friend');
    Route::get('/unfriend/{user:id}', [Peoples::class, 'unFriend'])->name('unfriend');
    Route::get('/cancle-friend/{user:id}', [Peoples::class, 'cancleFriend'])->name('cancle-friend');
    Route::get('/accept-friend/{user:id}', [Peoples::class, 'acceptFriend'])->name('accept-friend');
    Route::get('/reject-friend/{user:username}', [Peoples::class, 'rejectFriend'])->name('reject-friend');

    // channel
    Route::get('/create-channel', CreateChannel::class)->name('create-channel');
    Route::post('/create-channel', [CreateChannel::class, 'createChannel'])->name('create-channel');
    Route::get('/channels', Channels::class)->name('channels');
    Route::get('/channel/{page:id}', Channel::class)->name('channel.show');
});

// Route::get('/', Home::class)->middleware(['auth', 'verified', 'VerifiedUser']);
// Route::get('/create-post', CreatePost::class)->middleware(['auth', 'verified', 'VerifiedUser']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';