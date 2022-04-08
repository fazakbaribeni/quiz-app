@extends('layouts.app')

@section('content')
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row ">

        <div class="col-md-8">
        @if(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>

        @endif
            <div class="card">
                <div class="card-header"><strong>Exam</strong></div>

                @if($isExamAssigned)
                @foreach($quizzes as $quiz)

                <div class="card-body shadow-sm">
                    <h2 class="">{{$quiz->name}}</h2>
                    <p>About Exam: <strong>{{$quiz->description}}</strong></p>
                    <p>Time allocated: <strong>{{$quiz->minutes}} minutes</strong></p>
                    <p>Number of questions: <strong>{{$quiz->questions->count()}}</strong></p>
                    <p>
                        @if(!in_array($quiz->id,$wasQuizCompleted))
                        <a href="/quiz/{{$quiz->id}}">
                            <button class="btn btn-success">Start Quiz</button>
                        </a>
                        @else
                        <a href="/result/user/{{auth()->user()->id}}/quiz/{{$quiz->id}}">View Result</a>
                        <span class="float-right">Completed</span>
                        @endif

                    </p>

                </div>
                @endforeach
                @else
                    <p>You have not assigned any exam</p>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header shadow-lg"><strong>User Profile</strong></div>
                <div class="card-body shadow-sm">
                    <p>Email: <strong>{{auth()->user()->email}}</strong></p>
                    <p>Phone: <strong>{{auth()->user()->phone}}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
