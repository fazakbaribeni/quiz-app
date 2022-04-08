@extends('backend.layouts.master')

	@section('title','quiz questions')

	@section('content')

				<div class="span9">
                    <div class="content">

                    	 <!--foreach-->
                         @foreach($quizzes as $quiz)

                        <div class="module">
                            <div class="module-head">
                                  <h3>Quiz Name: {{$quiz->name}}</h3>
                            </div>

                            <div class="module-body">
                                <div class="module-body table">
                                     <!--foreach-->
                                    @php
                                    $q=0;
                                    @endphp
                                     @foreach($quiz->questions as $ques)
                                        @php
                                            $q++
                                        @endphp
                                    <table class="table table-message">
                                        <tbody>
                                            <tr class="read">

                                                <h2>{{ $q . "-". $ques->question}}</h2>

                                                <td class="cell-author hidden-phone hidden-tablet">
                                                     <!--foreach-->
                                                    @php
                                                    $i=0;
                                                    @endphp
                                                     @foreach($ques->answers as $answer)
                                                     @php
                                                     $i++
                                                     @endphp
                                                        <p>
                                                            <strong>{{$i ."-". $answer->answer}}</strong>

                                                            @if($answer->is_correct)
                                                           <span class="badge badge-info">
                                                            correct answer
                                                           </span>
                                                           @endif

                                                        </p>
                                                        @endforeach
                                                    <!--endforeach-->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endforeach
                                    <!--endforeach-->
                                </div>
                              @endforeach
                            <!--endforeach-->

                                <div class="module-foot">
                                <td>
                                    <a href="{{route('quiz.index')}}"><button class="btn btn-inverse pull-center">Back</button></a>
                                 </td>
                                </div>
                            </div>
                   		</div>

                		</div>

           			</div>


            </div>


@endsection
