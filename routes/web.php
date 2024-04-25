<?php

use App\Http\Controllers\admin\dashboardcontroller;
use App\Http\Controllers\authenticationcontroller;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\jobcontroller;
use App\Http\Controllers\postcontroller;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[homecontroller::class,'index'])->name('home');
Route::get('/jobs',[jobcontroller::class,'index'])->name('jobs');
Route::get('/job-details/{id}',[jobcontroller::class,'job_details'])->name('job.details');
Route::post('jobapplay-process',[jobcontroller::class,'job_applay_process'])->name('job.applay');
Route::post('save-job',[jobcontroller::class,'saved_job'])->name('save.job');
Route::get('save-job',[jobcontroller::class,'saved_job'])->name('save.job');


Route::group(['prefix'=>'admin','middleware'=>'checkstatus'],function(){
Route::get('dashboard',[dashboardcontroller::class,'Home'])->name('dashboard');
Route::get('alluser',[dashboardcontroller::class,'all_user'])->name('all.user');
Route::get('jobs',[dashboardcontroller::class,'all_job'])->name('all.job');
Route::get('jobs/delete/{id}',[dashboardcontroller::class,'delete_job'])->name('delete.job');
Route::post('jobs/status',[dashboardcontroller::class,'job_status'])->name('job.status');
Route::get('job-application',[dashboardcontroller::class,'job_application'])->name('job.application');
});

Route::group(['account'], function () {
    //guest route
    Route::group(['middleware'=> 'guest'], function () {
        Route::get('/account/register',[authenticationcontroller::class,'Register'])->name('register');
        Route::post('/account/register',[authenticationcontroller::class,'Register_process'])->name('register.process');
        
        Route::get('/account/login',[authenticationcontroller::class,'Login'])->name('login');
        Route::post('/account/login',[authenticationcontroller::class,'Login_process'])->name('login-process');
    });
    //auth route
    Route::group(['middleware'=> 'auth'], function () {
        Route::get('/account/logout',[authenticationcontroller::class,'Logout_process'])->name('logout');
        Route::get('/account/profile',[authenticationcontroller::class,'profile'])->name('profile');
        Route::post('/account/profile',[authenticationcontroller::class,'update_profile'])->name('update.profile');
        Route::post('/account/profile/upload-document',[authenticationcontroller::class,'Upload_image'])->name('upload.image');
        Route::get('/account/post',[postcontroller::class,'posts'])->name('posts');
        Route::post('/account/post',[postcontroller::class,'posts_process'])->name('posts-process');
        Route::get('/account/myposts',[postcontroller::class,'my_posts'])->name('myposts');
        Route::get('/account/myposts/edit/{id}',[postcontroller::class,'update_post'])->name('update.post');
        Route::post('/account/myposts/edit/{id}',[postcontroller::class,'update_post_process'])->name('update.post.process');
        Route::get('/account/myposts/delete/{id}',[postcontroller::class,'delete_post'])->name('delete.post');
        Route::get('/account/jobapply',[jobcontroller::class,'job_apply'])->name('account.jobapply');
        Route::get('/account/jobapply/delete/{id}',[jobcontroller::class,'delete_job_apply'])->name('delete.jobapply');
        Route::get('/account/saved-jobs',[jobcontroller::class,'saved_job_page'])->name('account.savejob');
        Route::get('/account/saved-jobs/delete/{id}',[jobcontroller::class,'delete_saved_job'])->name('delete.savejob');
        Route::post('/account/changepassword',[authenticationcontroller::class,'change_password'])->name('change.password');
    });
});