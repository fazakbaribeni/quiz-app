<?php

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


// We are not registering,reseting or verifying accounts
Auth::routes([
    'register'=>false,
    'reset'=>false,
    'verify'=>false
]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/quiz/{quizId}', [App\Http\Controllers\ExamController::class,'getQuizQuestions'])->middleware('auth');

/**
 * Middleware routes make sure logged in user can see the dashboard
 */
Route::group(['middleware'=>'isAdmin'],function (){



    Route::get('/', function () {
        return view('admin.index');
    });


    // Quiz Routes
Route::prefix('/quiz')->group(function () {
    Route::get('/', [App\Http\Controllers\QuizController::class, 'index'])->name('quiz.index');
    Route::get('/create', [App\Http\Controllers\QuizController::class, 'create'])->name('quiz.create');
    Route::post('/create', [App\Http\Controllers\QuizController::class, 'store'])->name('quiz.store');
    Route::get('{quiz}/question', [App\Http\Controllers\QuizController::class, 'question'])->name('quiz.question');
    Route::get('{quiz}/edit', [App\Http\Controllers\QuizController::class, 'edit'])->name('quiz.edit');
    Route::put('{quiz}/edit', [App\Http\Controllers\QuizController::class, 'update'])->name('quiz.update');
    Route::delete('{quiz}/destroy', [App\Http\Controllers\QuizController::class, 'destroy'])->name('quiz.destroy');
});

    // Quiz Routes
Route::prefix('/question')->group(function () {
    Route::get('/', [App\Http\Controllers\QuestionController::class, 'index'])->name('question.index');
    Route::get('{questuion}/show', [App\Http\Controllers\QuestionController::class, 'show'])->name('question.show');
    Route::get('/create', [App\Http\Controllers\QuestionController::class, 'create'])->name('question.create');
    Route::post('/create', [App\Http\Controllers\QuestionController::class, 'store'])->name('question.store');
    Route::get('{question}/edit', [App\Http\Controllers\QuestionController::class, 'edit'])->name('question.edit');
    Route::put('{question}/edit', [App\Http\Controllers\QuestionController::class, 'update'])->name('question.update');
    Route::delete('{question}/destroy', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('question.destroy');
});

// Quiz Routes
Route::prefix('/user')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('{user}/show', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/create', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::put('{user}/edit', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
});



    // Exams Route
    Route::get('exam/assign',[\App\Http\Controllers\ExamController::class, 'create'])->name('assign.exam');
    Route::post('exam/assign',[\App\Http\Controllers\ExamController::class, 'store'])->name('exam.store');
    Route::get('exam/user',[\App\Http\Controllers\ExamController::class, 'userExam'])->name('exam.user');
    Route::post('exam/remove',[\App\Http\Controllers\ExamController::class, 'removeExam'])->name('exam.remove');

});
