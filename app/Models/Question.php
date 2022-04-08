<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Answer;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question','quiz_id'];
    private $limit = 10;
    private $order = "DESC";



    public function answers()
    {
        return $this->hasMany(Answer::class);
    }


    /*
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function StoreQuestion($data){

        $data['quiz_id']= $data['quiz'];
        return Question::create($data);
    }


    /**
     * @return Quiz[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllQuestions(){

        return Question::orderBy('created_at',$this->order)
            ->with('quiz')
            ->paginate($this->limit);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getQuestionByID($id)
    {

        return Question::find($id);
    }


    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function updateQuestion($data, $id){

        $question = Question::find($id);
        $question->question = $data['question'];
        $question->quiz_id = $data['quiz'];
        $question->save();
        return $question;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function deleteQuestion($id)
    {
        return Question::find($id)->delete();
    }

}
