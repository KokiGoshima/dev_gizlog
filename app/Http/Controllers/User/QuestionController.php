<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Requests\User\QuestionsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    protected $question;

    public function __construct(Question $questionInstance, Str $strInstance)
    {
        $this->middleware('auth');
        $this->question = $questionInstance;
        $this->strInstance = $strInstance;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @see Question::getQuestionsByCategory
     * @see Question::getQuestionsByTitleWord
     * @see Question::getAllQuestions
     */
    public function index(Request $request)
    {
        $str = $this->strInstance;

        if ($request->tag_category_id && $request->tag_category_id !== 0){
            $category_num = $request->tag_category_id;
            $questions = $this->question->getQuestionsByCategory($category_num);
        }elseif ($request->search_word) {
            $searched_word = $request->search_word;
            $questions = $this->question->getQuestionsByTitleWord($searched_word);
        }else {
            $questions = $this->question->getAllQuestions();
        }

        return view('user.question.index', compact('questions', 'str'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->question->fill($input)->save();
        return redirect()->to('question');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        $user = Auth::user();
        return view('user.question.show', compact('question', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->find($id);
        return view('user.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $id)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->question->find($id)->fill($input)->save();
        return redirect()->route('question.mypage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \\Illuminate\Http\Response
     */
    public function confirm(QuestionsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $question = $this->question->fill($input);
        return view('user.question.confirm', compact('question'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.mypage');
    }

    /**
    * @param void
    * @return \Illuminate\Http\Response
    */
    public function showMypage()
    {
        $str = $this->strInstance;
        $user = Auth::user();
        $questions = $user->questions()->orderBy('created_at', 'desc')->get();
        return view('user.question.mypage', compact('questions', 'str'));
    }

}
