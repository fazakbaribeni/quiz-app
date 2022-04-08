<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(auth()->user()->is_admin == 1){
            return  redirect('/quiz');
        }
        $authUser  = Auth::user();

        $assignedQuizID = array();
        $user = DB::table('quiz_user')->where('user_id',$authUser->id)->get();

        foreach ($user as $userData){
            array_push($assignedQuizID, $userData->quiz_id);

        }


        $quizzes = Quiz::whereIn('id',$assignedQuizID)->get();
        $isExamAssigned = DB::table('quiz_user')->where('user_id',$authUser->id)->exists();
        $wasQuizCompleted = Result::where('user_id', $authUser->id)
            ->whereIn(
                'quiz_id',
                (new Quiz)->hasQuizAttempted())
                    ->pluck('quiz_id')
                    ->toArray();

        return view('home',compact('quizzes', 'wasQuizCompleted','isExamAssigned'));
    }
}
