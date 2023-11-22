<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ResetPassController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\ChangeRoleController;
use App\Http\Controllers\User\PhotoUploadController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SuspendController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VerifyController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\CssSelector\Node\FunctionNode;

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

//ForMainPage
Route::controller(PageController::class)->group(function(){
    Route::get("/","home")->name("page.home");
    Route::get("/detail/{slug}","detail")->name("page.detail");
    Route::get("/categories/{slug}","categorize")->name("page.categorize");
});



Auth::routes();

//Reset Password
Route::controller(ResetPassController::class)->group(function(){
    Route::get("/forgetPassword","forgetPassword")->name("password.forget");
    Route::post("/checkEmail","checkEmail")->name("email.check");
    Route::get("/reset-password","showResetUi")->name("password.reset");
    Route::post("/password-update","reset")->name("password.update");
});


Route::prefix("dashboard")->middleware("auth")->group(function () {

    //Dashboard Pages
    Route::get('/', [PageController::class, 'dashboard'])->name('page.dashboard');

    //User Model
    Route::get("/users", [UserController::class, "index"])->name("users.index")->can("viewAny", User::class);
    Route::delete("/users/destroy/{id}", [UserController::class, "destroy"])->name("users.destroy");

    Route::put("/role", [ChangeRoleController::class, "changeRole"])->name("users.role");

    Route::controller(SuspendController::class)->group(function () {
        Route::put("/suspend/active", "active")->name("users.active");
        Route::put("/suspend/ban", "ban")->name("users.ban");
    })->middleware("can:suspend,".User::class);

    Route::get("/profile", [ProfileController::class, "profile"])->name("users.profile");

    Route::controller(VerifyController::class)->group(function () {
        Route::get("/verify", "verify")->name("account.verify");
        Route::post("/verify", "check")->name("verify.check");
    });

    Route::put("/upload", [PhotoUploadController::class, "upload"])->name("users.photo");

    //Change Password
    Route::controller(ChangePasswordController::class)->group(function () {
        Route::get("/change-password", "changePass")->name("users.password");
        Route::put("/change-password/check", "check")->name("changePass.check");
    });

    //Category Model
    Route::resource("category", CategoryController::class)->middleware("can:viewAny,".Category::class);

    //Article Model
    Route::resource("article",ArticleController::class);

    //Comment
    Route::resource('comment', CommentController::class)->only(["store","update","destroy"])->middleware(["auth"]);
});
