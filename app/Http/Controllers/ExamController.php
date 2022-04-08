<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quiz = (new Quiz)->assignExam($request->all());
        return redirect()->back()->with('message','Exam Assigned to user sucessfully!');

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userExam(Request $request){
        $quizzes = Quiz::get();
        return view('backend.exam.index', compact('quizzes'));
    }

    /**
     * @param Request $request
     * @return void
     */
    public function removeExam(Request $request){

        $userID = $request->get('user_id');
        $quizID = $request->get('quiz_id');

        $quiz = Quiz::find($quizID);
        $result  = Result::where('quiz_id',$quizID)->where('user_id', $userID)->exists();

        // Can not delete
        if ($result){
            return redirect()->back()->with('message', 'User has completed this Quiz, there are answers in the database, Can not be delete!');
        }else{
            $quiz->users()->detach($userID);
            return redirect()->back()->with('message', 'Quiz removed Succesfully!');
        }
    }


    public function getQuizQuestions(Request $request, $quizID){
        $authUser = Auth::user();
        $quiz = Quiz::find($authUser->id);
        $time = Quiz::where('id', $quizID)->value('minutes');
        $quizQuestions = Question::where('quiz_id', $quizID)->with('answers')->get();
        $authUserHasPlayedQuiz = Result::where(['user_id'=>$authUser->id, 'quiz_id'=>$quizID])->get();

        return view('quiz',compact('quiz','time','quizQuestions','authUserHasPlayedQuiz'));
    }

}
