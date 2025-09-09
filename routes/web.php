<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TwoFactorController;


Route::get('/2fa/verify', [TwoFactorController::class, 'showVerifyForm'])->middleware('auth')->name('2fa.verify');

Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->middleware('auth')->name('2fa.verify.post');

// 2FA Setup QR Code display
Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->middleware('auth')->name('2fa.setup');

// OTP verify aur enable 2FA
Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->middleware('auth')->name('2fa.enable');

// Disable 2FA form show karne ke liye
Route::get('/2fa/disable', [TwoFactorController::class, 'showDisableForm'])->middleware('auth')->name('2fa.disable');

// Disable 2FA process karne ke liye
Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->middleware('auth')->name('2fa.disable.post');

// Route::get('/run-migration', function () {
//     Artisan::call('migrate', ['--force' => true]);
//     return 'Migration completed successfully!';
// });

Route::get('user-login', function(){
    if(!session()->has('user')){
        return view('user-login');
    }else{
        return redirect('/');
    }
});

Route::get('user-signup', function(){
    if(!session()->has('user')){
        return view('user-signup');
    }else{
        return redirect('/');
    }
});


Route::post('/user-login',[UserController::class,'userLogin']);
Route::middleware('CheckUserAuth')->group(function(){
    // Route::view('user-login','user-login');
    Route::get('/user-login-quiz',[UserController::class,'userLoginQuiz']);
    Route::get('/search-quiz',[UserController::class,'searchQuiz']);
    Route::get('/verify-user/{email}',[UserController::class,'verifyUser']);
    Route::get('/',[UserController::class,'welcome'])->name('home');
    Route::view('user-forgot-password','user-forgot-password');
    Route::post('user-forgot-password',[UserController::class,'userForgotPassword']);
    Route::get('user-forgot-password/{email}',[UserController::class,'userResetForgotPassword']);
    Route::post('user-set-forgot-password',[UserController::class,'userSetForgotPassword']);
    Route::get('/user-quiz-list/{id}/{category}',[UserController::class,'userQuizList']);
    Route::get('/start-quiz/{id}/{name}',[UserController::class,'startQuiz']);
    // Route::view('user-signup','user-signup');
    Route::post('/user-signup',[UserController::class,'userSignup'])->name('user-signup');
    Route::get('verify/otp', [UserController::class, 'verifyOtp'])->name('verify.otp');
    Route::post('verify/otp/store', [UserController::class, 'verifyOtpStore'])->name('verify.otp.store');
    Route::get('/user-logout',[UserController::class,'userLogout']);
    Route::get('/user-signup-quiz',[UserController::class,'userSignupQuiz']);
    
    Route::get('categories-list',[UserController::class, 'categories']);
    Route::get('certificate',[UserController::class, 'certificate']);
    Route::get('download-certificate',[UserController::class, 'downloadCertificate']);

    Route::get('/mcq/{id}/{name}',[UserController::class,'mcq']);
    Route::post('/submit-next/{id}',[UserController::class,'submitAndNext']);
    Route::get('/user-details',[UserController::class,'userDetails']);
});

Route::view('admin-login', 'admin-login');
Route::view('signup', 'signup');

Route::post('admin-login',[AdminController::class,'login'])->name('login');
Route::post('admin-signup',[AdminController::class,'signup'])->name('signup');


Route::middleware('CheckAdminAuth')->group(function(){
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('admin-categories',[AdminController::class,'categories']);
    Route::get('admin-logout',[AdminController::class,'logout']);
    Route::post('add-category',[AdminController::class,'addCategory']); 
    Route::get('category/delete/{id}',[AdminController::class,'deleteCategory'])->name('delete'); 
    Route::get('add-quiz',[AdminController::class,'addQuiz']);
    Route::post('add-mcq',[AdminController::class,'addMCQs']);
    Route::get('end-quiz',[AdminController::class,'endQuiz']);
    Route::get('show-quiz/{id}',[AdminController::class,'showQuiz']);
    Route::get('quiz-list/{id}/{category_name}',[AdminController::class,'quizList']);
    Route::post('quiz-list/{id}',[AdminController::class,'quizDelete'])->name('quizDelete');
    Route::get('/dashboard/user-view/{id}',[AdminController::class,'userView'])->name('user-view');
    Route::get('/dashboard/update/{id}',[AdminController::class,'getUser'])->name('user-get');
    Route::post('/dashboard/update-user/{id}', [AdminController::class, 'updateUser'])->name('user-update');
    Route::post('/dashboard/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('user-delete');
});


//other routes

Route::view('/adminpop', 'admin-pop');