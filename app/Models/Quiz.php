<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','minutes'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|void
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }


    /**
     * @param $data
     * @return mixed
     */
    public function StoreQuiz($data){
        return Quiz::create($data);
    }


    /**
     * @return Quiz[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllQuiz(){

        return Quiz::all();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getQuizByID($id)
    {

        return Quiz::find($id);
    }


    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function updateQuiz($data, $id){
        return Quiz::find($id)->update($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function deleteQuiz( $id)
    {
        return Quiz::find($id)->delete();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(User::class, 'quiz_user');
    }


    /**
     * @param $data
     * @return mixed
     */
    public function assignExam($data){

        $quizID = $data['quiz_id'];
        $quiz = Quiz::find($quizID);
        $userID = $data['user_id'];

        return $quiz->users()->syncWithoutDetaching($userID);

    }

    /**
     * @return void
     */
    public function hasQuizAttempted(){

        $attemptQuiz = array();
        $authUser = Auth::user();

        $results = Result::where('user_id',$authUser->id)->get();

        foreach ($results as $userResult){
            array_push($attemptQuiz,$userResult->quiz_id);
        }

        return $attemptQuiz;

    }

}
