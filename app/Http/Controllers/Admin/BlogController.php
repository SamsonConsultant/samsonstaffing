<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

use Intervention\Image\Facades\Image;

use App\Models\Post;
use App\Models\PostExtra;
use App\Mail\MainTemplate;

use Request as RequestsUrl;
use App\User;
use Config;
use Validator;
use Auth;
use DB;

class BlogController extends Controller
{
    public $upload_path;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $guard = 'admin';

    public function __construct() {
        $this->middleware('auth:admin');

        $this->upload_path = \Config::get('constants.upload_path');
        $imagePath = public_path($this->upload_path);
        if(!File::exists($imagePath)) File::makeDirectory($imagePath, 0777, true, true );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $template = 'blog-list';

        $blogs = get_post_data('blog');

        return view('pages.admin.index', compact('template', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $template = 'blog-create';
        return view('pages.admin.index', compact('template'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $template = 'blog-edit';

        $page = Post::where('id', $id)->first();
        if (empty($page)) {
            return redirect()->back()->with('error', 'Blog not found.');
        }

        return view('pages.admin.index', compact('template', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
