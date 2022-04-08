<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;
use SebastianBergmann\CodeCoverage\Node\AbstractNode;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['question_id','answer', 'is_correct'];

    /****
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question(){

        return $this->belongsTo(Question::class);
    }


    /***
     * @param $data
     * @param $question
     * @return void
     */
    public function storeAnswer($data, $question){

        foreach ($data['options'] as $key => $option){
            $is_correct = 0;

            if($key == $data['correct_answer']){
                $is_correct = 1;
            }

            $answer = Answer::create([
                "question_id"=>$question->id,
                "answer"=>$option,
                "is_correct"=> $is_correct
            ]);

        }
    }


    /**
     * @param $questionID
     * @return void
     */
    public function deleteAnswer($questionID){
        Answer::where('question_id', $questionID)->delete();
    }



    /***
     * @param $data
     * @param $question
     * @return void
     */
    public function updateAnswer($data, $question){

        // Delete the old answers
        $delete = $this->deleteAnswer($question->id);
        $reStore = $this->storeAnswer($data, $question);

    }

}
