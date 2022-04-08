<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = (new Quiz)->getAllQuiz();
         return view('backend.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $this->validateForm($request);
      $quiz  = (new Quiz)->storeQuiz($data);

        if($quiz){
            return redirect((route('quiz.index')))->with('message', 'Quiz Created Succesfully!');
        }
    }


    /******
     * @param Quiz $quiz
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {

        $quiz = (new Quiz)->getQuizByID($id);

        return view('backend.quiz.edit',compact('quiz'));

    }


    /**
     * @param Request $request
     * @param $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validateForm($request);
        $quiz = (new Quiz)->updateQuiz($data, $id);

        return redirect((route('quiz.index')))->with('message', 'Quiz Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = (new Quiz)->deleteQuiz($id);

        if($delete){
            return redirect((route('quiz.index')))->with('message', 'Quiz Deleted Succesfully!');
        }
    }


    /****
     * @param $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateForm($request){

        return $this->validate($request,[

            'name'=>'required|string',
            'description'=>'required|min:3|max:500',
            'minutes'=>'required|integer'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function question($id)
    {
        $quizzes = Quiz::with('questions')->where('id', $id)->get();
        return view('backend.quiz.question', compact('quizzes'));
    }

}
