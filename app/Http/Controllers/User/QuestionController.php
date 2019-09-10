<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\TagCategory;
use App\Http\Requests\User\QuestionsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    protected $question;
    protected $str;
    protected $tag_category;

    public function __construct(Question $question, Str $str, TagCategory $tag_category)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->str = $str;
        $this->tag_category = $tag_category;
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
        $str = $this->str;
        $tag_categories = $this->tag_category->all();
        $category_num = $request->tag_category_id;
        $search_word = $request->search_word;

        if ($category_num !== '0' || isset($search_word)){
            $questions = $this->question->getQuestionsWithSearch($category_num, $search_word);
        }else {
            $questions = $this->question->getAllQuestions();
        }

        return view('user.question.index', compact('str', 'tag_categories', 'category_num', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag_categories = $this->tag_category->all();
        $category_array = $this->setCategoryArray();
        return view('user.question.create', compact('tag_categories', 'category_array'));
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
        $category_array = $this->setCategoryArray();
        return view('user.question.edit', compact('question', 'category_array'));
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
        $user = Auth::user();
        $input = $request->all();
        if (isset($request->id)){
            $input['id'] = $request->id;
        }
        return view('user.question.confirm', compact('user', 'input'));
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
        $str = $this->str;
        $user = Auth::user();
        $questions = $this->question
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->with('comments')
            ->with('tagCategory')
            ->get();
        return view('user.question.mypage', compact('questions', 'str'));
    }

    public function setCategoryArray()
    {
        $categories = $this->tag_category->all();
        $res = [];
        $res[''] = 'Select category';
        foreach ($categories as $key => $category) {
            $res[$key+1] = $category->name;
        }
        return $res;
    }

}
