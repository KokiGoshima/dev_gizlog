<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\TagCategory;
use App\Http\Requests\User\QuestionsRequest;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    const SELECT_BOX_DEFAULT_MESSAGE = 'Select Categories...';

    protected $question;
    protected $tagCategory;

    public function __construct(Question $question, TagCategory $tagCategory)
    {
        $this->question = $question;
        $this->tagCategory = $tagCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @see Question::getQuestionsWithSearch
     * @see Question::getAllQuestions
     */
    public function index(Request $request)
    {
        $tagCategories = $this->tagCategory->all();
        $categoryNum = $request->tag_category_id;
        $searchWord = $request->search_word;
        $questions = $this->question->getQuestions($categoryNum, $searchWord);
        $request->flashOnly('search_word');
        return view('user.question.index', compact('tagCategories', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param void
     * @return \Illuminate\Http\Response
     * @see QuestionController::categoryArray
     */
    public function create()
    {
        $tagCategories = $this->tagCategory->all();
        $categoryArray = $this->makeCategoryArray($tagCategories);
        return view('user.question.create', compact('tagCategories', 'categoryArray'));
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
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->with(['comments.user'])->find($id);
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
        $tagCategories = $this->tagCategory->all();
        $question = $this->question->find($id);
        $categoryArray = $this->categoryArray($tagCategories);
        return view('user.question.edit', compact('question', 'categoryArray'));
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
        return view('user.question.confirm', compact('request'));
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
    * @see Question::getMyQuestions
    */
    public function showUserPage()
    {
        $questions = $this->question->getUserQuestions(Auth::id());
        return view('user.question.mypage', compact('questions'));
    }

    /**
    * @param Collection $tagCategories
    * @return array
    */
    private function makeCategoryArray($tagCategories)
    {
        return $tagCategories
            ->pluck('name', 'id')
            ->prepend(self::SELECT_BOX_DEFAULT_MESSAGE, '');
    }

}
