<?php

use App\Http\Controllers\LineChartController;
use App\Http\Controllers\ProfileController;
use App\Livewire\AllUsers;
use App\Livewire\ContactAdmin;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Admin;
use App\Livewire\Components\CreatePost;
use App\Livewire\Components\ShowPost;
use App\Livewire\Peoples;
use App\Livewire\Profile;
use App\Livewire\ProfileEdit;
use App\Livewire\Channel;
use App\Livewire\Channels;
use App\Livewire\CreateChannel;
use App\Livewire\MyChannels;
use App\Livewire\Notification;
use App\Livewire\CreateChannelPost;
use App\Livewire\ShowChannelPost;
use App\Livewire\SavedPostController;
use App\Livewire\PostEdit;
use App\Livewire\CreateSquadPost;
use App\Livewire\ShowSquadPost;
use App\Livewire\Squad;
use App\Livewire\Squads;
use App\Livewire\CreateSquad;
use App\Livewire\MySquad;
use Illuminate\Support\Facades\Auth;



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
    Route::get('/home', Home::class)->name('home');
    Route::get('/admin', Admin::class)->name('admin');
    Route::get('/contact-admin', ContactAdmin::class)->name('contact-admin');
    Route::post('/contact.admin/{user:id}', [ContactAdmin::class, 'contact'])->name('contact.admin');

    Route::get('/profile/{user:username}', Profile::class)->name('profile.show');
    Route::get('/profile/{user:username}/edit', ProfileEdit::class)->name('profile-edit');
    Route::post('/profile.edit', [ProfileEdit::class, 'profileEdit'])->name('profile.edit');
    Route::get('/profile/{user:username}/delete', [Profile::class, 'deleteProfile'])->name('profile.delete');

    // create post
    Route::get('/create-post', CreatePost::class)->name('create-post');
    Route::post('/createpost', [CreatePost::class, 'createpost'])->name('createpost');

    // post
    Route::get('/post/{post:uuid}', ShowPost::class)->name('post.show');
    Route::get('/post/{post:id}/like', [Home::class, 'like'])->name('post.like');
    Route::get('/post/{post:id}/dislike', [Home::class, 'dislike'])->name('post.dislike');
    Route::post('/post/{post:id}/comment', [ShowPost::class, 'saveComment'])->name('post.comment');
    Route::get('/post/{post:uuid}/delete', [ShowPost::class, 'deletePost'])->name('post.delete');

    // edit post
    Route::get('/post/edit/{post:uuid}', PostEdit::class)->name('post.edit');
    Route::post('/post/edit/{post:uuid}', [ShowPost::class, 'editPost'])->name('post.edit');
    Route::get('/save-post/{post:id}', [SavedPostController::class, 'savePost'])->name('save-post');
    Route::get('/unsave-post/{post:id}', [SavedPostController::class, 'unsavePost'])->name('unsave-post');
    Route::get('/save-posts', SavedPostController::class)->name('save-posts');
    Route::get('/share-post/{post:id}', [Home::class, 'sharePost'])->name('share-post');

    // friends
    Route::get('/friends', Peoples::class)->name('friends');
    Route::get('/add-friend/{user:id}', [Peoples::class, 'addFriend'])->name('add-friend');
    Route::get('/unfriend/{user:id}', [Peoples::class, 'unFriend'])->name('unfriend');
    Route::get('/cancle-friend/{user:id}', [Peoples::class, 'cancleFriend'])->name('cancle-friend');
    Route::get('/accept-friend/{user:id}', [Peoples::class, 'acceptFriend'])->name('accept-friend');
    Route::get('/reject-friend/{user:username}', [Peoples::class, 'rejectFriend'])->name('reject-friend');


    // channel post create
    Route::get('/channel/createPost/{page:uuid}', CreateChannelPost::class)->name('channel.create-post');
    Route::post('/channel/createPost/{page:uuid}', [CreateChannelPost::class, 'createPost'])->name('channel.createpost');
    // squad post create
    Route::get('/squad/createPost/{page:uuid}', CreateSquadPost::class)->name('squad.create-post');
    Route::post('/squad/createPost/{page:uuid}', [CreateSquadPost::class, 'createPost'])->name('squad.createpost');

    // channel post
    Route::get('/channel/post/{post:uuid}', ShowChannelPost::class)->name('channel.post.show');
    // squad post
    Route::get('/squad/post/{post:uuid}', ShowSquadPost::class)->name('squad.post.show');

    // channel
    Route::get('/create-channel', CreateChannel::class)->name('create-channel');
    Route::post('/create-channel', [CreateChannel::class, 'createChannel'])->name('create-channel');
    Route::get('/channels', Channels::class)->name('channels');
    Route::get('/my-channels', MyChannels::class)->name('my-channels');
    Route::get('/channel/{page:uuid}', Channel::class)->name('channel.show');
    Route::get('/follow-channel/{page:id}', [Channel::class, 'followChannel'])->name('follow-channel');
    Route::get('/unfollow-channel/{page:id}', [Channel::class, 'unfollowChannel'])->name('unfollow-channel');
    Route::get('/delete-channel/{page:id}', [Channel::class, 'deleteChannel'])->name('delete-channel');

    // squad
    Route::get('/create-squad', CreateSquad::class)->name('create-squad');
    Route::post('/create-squad', [CreateSquad::class, 'createSquad'])->name('create-squad');
    Route::get('/squads', Squads::class)->name('squads');
    Route::get('/my-squads', MySquad::class)->name('my-squads');
    Route::get('/squad/{group:uuid}', Squad::class)->name('squad.show');
    Route::get('/join-squad/{group:id}', [Squad::class, 'joinSquad'])->name('join-squad');
    Route::get('/leave-squad/{group:id}', [Squad::class, 'leaveSquad'])->name('leave-squad');
    Route::get('/delete-squad/{group:id}', [Squad::class, 'deleteSquad'])->name('delete-squad');

    // notification
    Route::get('/notification', Notification::class)->name('notification');
    Route::get('/mark-as-read/{notification:id}', [Notification::class, 'markAsRead'])->name('mark-as-read');
    Route::get('/mark-all-as-read', [Notification::class, 'markAllAsRead'])->name('mark-all-as-read');

    Route::get('/delete&ban/{post:uuid}', [ShowPost::class, 'deleteAndBan'])->name('delete&ban');
    Route::get('/ban/{user:id}', [Admin::class, 'ban'])->name('admin.ban');
    Route::get('/unban/{user:id}', [Admin::class, 'unban'])->name('admin.unban');
    Route::get('/unlock/{user:id}', [Admin::class, 'unlock'])->name('admin.unlock');
    Route::get('/all-users', AllUsers::class)->name('all-users');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
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

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
})->name('terms-and-conditions');

Route::get('/', function () {
    return view('welcome');
})->middleware('check.username');

require __DIR__ . '/auth.php';