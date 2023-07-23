<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Str;
use Auth;


class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $guard = 'admin';

    /**
     * 
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index(){
        $categories = Category::all();

        $template = 'cat-list';
        return view('pages.admin.index', compact('categories','template'));
    }

    public function create(){
        $template = 'cat-create';
        return view('pages.admin.index', compact('template'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $slug = Str::slug($request->title, $separator = "-", app()->getLocale());
        $category->title = $request->title;
        $category->slug = $slug;
        $category->content = $request->content ?? null;
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category){
        $template = 'cat-edit';
        return view('pages.admin.index', compact('template','category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->title = $request->title;
        $category->content = $request->content;
        $category->save();

        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category){

        $template = 'cat-show';
        return view('pages.admin.index', compact('template','category'));
    }

    public function destroy(Category $category){
        $category->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoryRequest $request){
        Category::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
