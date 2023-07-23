<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

use App\Models\Post;
use App\Models\PostExtra;
use App\Models\Menu;
use App\Models\Navbar;
use App\Models\UserEducation;
use App\Models\UserExperince;
use App\Models\JobManageMent;
use App\Models\Job;
use App\Models\Project;
use App\Models\Contact;

use App\Mail\MainTemplate;

use Request as RequestsUrl;
use App\User;
use Config;
use Validator;
use Auth;
use DB;

class OtherContentController extends Controller
{
    public $upload_path;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $guard = 'admin';

    public function __construct() {
        $this->middleware('auth:admin')->except(['storeUserProfile', 'changeJobStatus', 'sendBulkMail', 'setInterView','changeInterviewStatus','storeOfferLetter']);

        $this->upload_path = \Config::get('constants.upload_path');
        $imagePath = public_path($this->upload_path);
        if(!File::exists($imagePath)) File::makeDirectory($imagePath, 0777, true, true );
    }


    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pageList(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $pages = get_post_data('page', $request);

        return view('pages.admin.index', compact('template', 'segments', 'pages'));
    }

    /**
     * Show the add page content blade.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pageCreate(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        return view('pages.admin.index', compact('template', 'segments'));
    }

    /**
     * Show the page edit content.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pageEdit(Request $request, $id){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $page = Post::where('id', $id)->first();
        if (empty($page)) {
            return redirect()->back()->with('error', 'Page not found.');
        }

        return view('pages.admin.index', compact('template', 'segments', 'page'));
    }

    /**
     * Show the page edit content.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pageDelete($id){
        PostExtra::where('post_id', $id)->delete();
        Post::where('id', $id)->delete();
        Navbar::where('route_id', $id)->delete();

        return redirect()->back()->with('success', 'Action completed..!');
    }

    /**
     * Store the page content.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pageStore(Request $request){
        try {
            $arr = [
                'post_title' => 'required',
                'myfile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $input = $request->all();
            $img_url = '';
            $images = [];
            if ($request->file('myfile') && $request->hasFile('myfile')) {
                $imagePath = $request->file('myfile');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $imageName = str_replace(' ', '-', $imageName);
                $img_url = $this->upload_path . '' . $imageName;
                $destinationPath = public_path($this->upload_path);

                # resize the images in small medium large...
                //get filename with extension
                $fileextension = $request->file('myfile')->getClientOriginalName();
                //get filename without extension
                $filename = pathinfo($fileextension, PATHINFO_FILENAME);
                //get file extension
                $extension = $request->file('myfile')->getClientOriginalExtension();
                //small thumbnail name
                $smallthumbnail = $filename.'_small_'.time().'.'.$extension;
                //medium thumbnail name
                $mediumthumbnail = $filename.'_medium_'.time().'.'.$extension;
                //large thumbnail name
                $largethumbnail = $filename.'_large_'.time().'.'.$extension;
                $realPath = $imagePath->getRealPath();                

                $images['full'] = $img_url;
                $images['small'] = $this->upload_path . '' . $smallthumbnail;
                $images['medium'] = $this->upload_path . '' . $mediumthumbnail;
                $images['large'] = $this->upload_path . '' . $largethumbnail;

                //create small thumbnail
                $smallthumbnailpath = public_path($this->upload_path.$smallthumbnail);
                $this->createThumbnail($realPath, $smallthumbnailpath, 150, 93);
                
                //create medium thumbnail
                $mediumthumbnailpath = public_path($this->upload_path.$mediumthumbnail);
                $this->createThumbnail($realPath, $mediumthumbnailpath, 300, 185);
                
                //create large thumbnail
                $largethumbnailpath = public_path($this->upload_path.$largethumbnail);
                $this->createThumbnail($realPath, $largethumbnailpath, 550, 340);

                $imagePath->move($destinationPath, $imageName);
            }

            if ($request->has('post_id') && $request->filled('post_id')) {
                $post = Post::where('id', $request->post_id)->where('post_type', $request->post_type)->first();
                $post->post_title      =   $request->post_title;
                $post->short_content   =   $request->short_content;
                $post->full_content    =   $request->full_content;
                $post->post_slug       =   createSlug($request->post_title);
                if(!empty($img_url)){
                    $post->src_url       =   $img_url;
                }
            } else {
                $post = new Post;
                $post->author_id  =   Auth::user()->id;
                $post->post_title      =   $request->post_title;
                $post->short_content   =   $request->short_content;
                $post->full_content    =   $request->full_content;
                $post->post_slug       =   createSlug($request->post_title);
                $post->post_type       =   $request->post_type;
                if(!empty($img_url)){
                    $post->src_url       =   $img_url;
                }
            }
            
            if($post->save()){
                if(count($images) > 0){
                    set_post_key_value($post->id, 'images', json_encode($images));
                }

                return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
            } else{
                return response()->json(['message' => 'Action is not completed.', 'status' => 200], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }


    /**
     * Create a thumbnail of specified size
     *
     * @param string $path path of thumbnail
     * @param int $width
     * @param int $height
     */
    public function createThumbnail($realPath, $path, $width, $height){        
        $img = Image::make($realPath)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($path);
    }


    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addReviewContent(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        return view('pages.admin.index', compact('template', 'segments'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageReviewContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('review', $request);

        if(!empty($id)){
            $template = 'edit-review';            
            $post = Post::where('post_type', 'review')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Review Store
     * 10-Mar-22
     */
    public function storeReview(Request $request){
        try {
            $arr = [
                'post_title' => 'required',
                'short_content' => 'required',
                'full_content' => 'required',
                'rating' => 'required',
            ];

            if ($request->has('myfile') && $request->filled('myfile') && $request->file('myfile')) {
                $arr['myfile'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            }

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $input = $request->all();
            $img_url = '';            
            if ($request->file('myfile')) {
                $imagePath = $request->file('myfile');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $imageName = str_replace(' ', '-', $imageName);
                $request->myfile->move(public_path($this->upload_path), $imageName);
                $img_url = $this->upload_path . '' . $imageName;
            }

            if ($request->has('post_id') && $request->filled('post_id')) {                
                $post = Post::where('id', $request->post_id)->where('post_type', 'review')->first();
                $post->post_title      =   $request->post_title;
                $post->short_content    =   $request->short_content;
                $post->full_content    =   $request->full_content;
                $post->post_slug       =   createSlug($request->post_title);
                if(!empty($img_url)){
                    $post->src_url       =   $img_url;
                }
            } else {
                $post = new Post;
                $post->author_id  =   Auth::user()->id;
                $post->post_title      =   $request->post_title;
                $post->short_content    =   $request->short_content;
                $post->full_content    =   $request->full_content;
                $post->post_slug       =   createSlug($request->post_title);
                $post->post_type       =   'review';

                if(!empty($img_url)){
                    $post->src_url       =   $img_url;
                }
            }
            
            if($post->save()){
                set_post_key_value($post->id, 'rating', $request->rating);

                return response()->json(['message' => 'You have added the Review successfully.', 'status' => 201], 201);
            } else{
                return response()->json(['message' => 'Action is not completed.', 'status' => 200], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }


    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageExperienceContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('experience', $request);

        if(!empty($id)){
            $template = 'manage-experience';
            $post = Post::where('post_type', 'experience')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageRolesContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('roles', $request);

        if(!empty($id)){
            $template = 'manage-roles';
            $post = Post::where('post_type', 'roles')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageCandidateContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('candidate_profile', $request);

        if(!empty($id)){
            $template = 'manage-candidate';
            $post = Post::where('post_type', 'candidate_profile')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageEducationContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('education', $request);

        if(!empty($id)){
            $template = 'manage-education';            
            $post = Post::where('post_type', 'education')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageIndustryContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('industry_type', $request);
        
        if(!empty($id)){
            $template = 'manage-industry';            
            $post = Post::where('post_type', 'industry_type')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageAreaContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('area', $request);
        
        if(!empty($id)){
            $template = 'manage-area';            
            $post = Post::where('post_type', 'area')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageEmploymentContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('employement_type', $request);
        
        if(!empty($id)){
            $template = 'manage-employment';            
            $post = Post::where('post_type', 'employement_type')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageCategoryContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('role_category', $request);

        if(!empty($id)){
            $template = 'manage-category';            
            $post = Post::where('post_type', 'role_category')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }

    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageKeySkillContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('key_skills', $request);

        if(!empty($id)){
            $template = 'manage-skills';            
            $post = Post::where('post_type', 'key_skills')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }


    /**
     * Review Store
     * 10-Mar-22
     */
    public function storeMasterData(Request $request){
        try {
            $arr = [
                'post_title' => 'required'                
            ];
            
            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            if ($request->has('post_id') && $request->filled('post_id')) {                
                $post = Post::where('id', $request->post_id)->where('post_type', $request->post_type)->first();
                $post->post_title      =   $request->post_title;
                $post->post_slug       =   createSlug($request->post_title);                
            } else {
                $post = new Post;
                $post->author_id  =   Auth::user()->id;
                $post->post_title      =   $request->post_title;
                $post->post_slug       =   createSlug($request->post_title);
                $post->post_type       =   $request->post_type;
            }
            
            if($post->save()){
                return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
            } else{
                return response()->json(['message' => 'Action is not completed.', 'status' => 200], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }


    /**
     * Show the application manage Review.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageAccountTypeContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = get_post_data('account_type', $request);

        if(!empty($id)){
            $template = 'manage-account-type';            
            $post = Post::where('post_type', 'account_type')->find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }


    /**
     * store the user profile
     * cody by sanjay
     */
    public function storeUserProfile(Request $request){
        try{
            $arr = [
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_number' => 'required|numeric|digits_between:10,15',
                'home_phone' => 'nullable|numeric|digits_between:10,15',
                'email' => 'required|email|unique:users,email',
                'country_id' => 'required',
                'state_id' => 'required',
                'address' => 'required',
                'city' => 'required',
                'zip_code' => 'required',
                'lang_speak' => 'required',
                'lang_written' => 'required',
                'company_name' => 'required|array|min:1',
                'position_title' => 'required|array|min:1',
                'start_date' => 'required|array|min:1',
                'exp_year' => 'required|array|min:1',
                'college_name' => 'required|array|min:1',
                'university_name' => 'required|array|min:1',
                'ed_start_date' => 'required',
                'myfile' => 'required|max:10000|mimes:doc,docx,pdf',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $job = Job::where('id', $request->job_id)->first();

            // dd($request->all());
            $all_data = $request->all();
            $user = User::where('email', $request->email)->first();
            if(empty($user)){
                $user = new User;
            }
            $user->name = $request->first_name.' '.$request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make('abc@123');
            $user->role_id = '3';
            $user->status = '1';
            $user->remember_token = time();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->contact_number = $request->contact_number;
            $user->home_phone = $request->home_phone ?? '';
            $user->gender = $request->gender ?? '';
            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->zip_code = $request->zip_code;
            $user->lang_speak = $request->lang_speak;
            $user->lang_written = $request->lang_written;
            $user->current_ctc = $request->current_ctc ?? '';
            $user->notice_period = $request->notice_period ?? '';

            if($request->has('user_lang')){
                $user->user_lang = implode(',', $request->user_lang);
            }
            
            if ($request->file('myfile')) {
                $imagePath = $request->file('myfile');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $imageName = str_replace(' ', '-', $imageName);
                $request->myfile->move(public_path($this->upload_path), $imageName);
                $user->current_cv = $this->upload_path . '' . $imageName;
            }

            if ($user->save()) {
                // work experince
                if($request->has('company_name') && $request->filled('company_name')){
                    if(count($request->company_name) > 0){
                        foreach ($request->company_name as $key => $value) {
                            // code...
                            $n_exp = new UserExperince;
                            $n_exp->user_id = $user->id;
                            $n_exp->company_name = $all_data['company_name'][$key] ?? '';
                            $n_exp->position_title = $all_data['position_title'][$key] ?? '';
                            $n_exp->current_position = $all_data['current_position'][$key] ?? '';
                            $n_exp->start_date = $all_data['start_date'][$key] ?? '';
                            $n_exp->end_date = $all_data['end_date'][$key] ?? '';
                            $n_exp->exp_year = $all_data['exp_year'][$key] ?? '';
                            $n_exp->exp_month = $all_data['exp_month'][$key] ?? '';
                            $n_exp->save();
                        }
                    }
                }

                // education 
                if($request->has('college_name') && $request->filled('college_name')){
                    if(count($request->college_name) > 0){
                        foreach ($request->college_name as $key => $value) {
                            // code...
                            $n_ed = new UserEducation;                            
                            $n_ed->user_id = $user->id;
                            $n_ed->college_name = $all_data['college_name'][$key] ?? '';
                            $n_ed->degree_name = $all_data['degree_name'][$key] ?? '';
                            $n_ed->university_name = $all_data['university_name'][$key] ?? '';
                            $n_ed->start_date = $all_data['ed_start_date'][$key] ?? '';
                            $n_ed->end_date = $all_data['ed_end_date'][$key] ?? '';                            
                            $n_ed->save();
                        }
                    }
                }

                // apply job
                $jobmg = new JobManageMent;
                $jobmg->user_id = $user->id;
                $jobmg->job_id = $job->id;
                $jobmg->created_by = $job->created_by;
                $jobmg->state_id = $job->location_id;
                $jobmg->cv_path = $user->current_cv;
                $jobmg->cv_status = '1';
                $jobmg->save();

                return response()->json(['message' => 'You have updated information successfully.', 'status' => 201], 201);
            }

            return response()->json(['message' => 'User save data problem.', 'status' => 200], 200);
        } catch(\Exception $e){
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * 
     */
    public function changeJobStatus($job_id, $status_id, $user_id){
        $job = JobManageMent::where('id', $job_id)->first();
        $job->status = $status_id;
        $job->updated_by = $user_id;
        $job->save();
        return redirect()->back()->with('success', 'Action completed.');
    }

    /**
     * send bulk mail to admin
     * cody by sanjay
     */
    public function sendBulkMail(Request $request){
        try {
            $arr = [
                'items_id' => 'required',
                'mail_format' => 'required|array|min:1',
                'to_email' => 'required',
                'subject' => 'required',
                'body' => 'required',
            ];

            $arr_msg = [
                'items_id.required' => 'Please select at least one job to send mail.',
                'mail_format.required' => 'Please select at least one mail format.',
            ];

            $validator = Validator::make($request->all(), $arr, $arr_msg);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }
                        
            $items_id = explode(',', $request->items_id);
            $all_email = explode(',', $request->to_email);
            $all_job = JobManageMent::whereIn('id', $items_id)->get();            
            
            // send mail here..
            /*$get_view_data['subject']    =   $request->subject;
            $get_view_data['view']       =   'mails.bulk-mail';
            $get_view_data['user']       =   [
                'name' =>  'Dear',
                'message' => $request->body,
                'total_user' => count($all_job),
                'all_job' => $all_job,
                'mail_format' => $request->mail_format,
            ];*/

            // another way
            $user = [
                'name' =>  'Dear',
                'message' => $request->body,
                'total_user' => count($all_job),
                'all_job' => $all_job,
                'mail_format' => $request->mail_format,
            ];

            $html = view('mails.bulk-mail', compact('user'))->render();
            $js_data = [
                'html' => $html,
                'to_mail' => $request->to_email,
                'subject' => $request->subject
            ];

            try{
                $up_job = JobManageMent::whereIn('id', $items_id)->update(['updated_by' => $request->user_id]);
                // $mail = Mail::to($all_email)->send(new MainTemplate( $get_view_data ));
                $response = sendMail($js_data);
                $code = json_decode($response);
                if($code->flag){
                    return response()->json(['message' => 'Mail send successfully.', 'status' => 201], 201);
                }
                return response()->json(['message' => 'Mail not sent successfully.', 'status' => 201], 201);
            }catch(\Swift_TransportException $transportExp){
                return response()->json(['message' => 'Mail not sent successfully.', 'status' => 201], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * send bulk mail to admin
     * cody by sanjay
     */
    public function setInterView(Request $request){
        try {
            $arr = [
                'title' => 'required',
                'email' => 'required',
                'st_date' => 'required',
                'st_time' => 'required',
                'ed_date' => 'required',
                'ed_time' => 'required',
                'meating_url' => 'required',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors(), 'status' => 422],422);
            }

            $job = JobManageMent::where('id', $request->job_mg_id)->first();
            $job->title = $request->title;
            $job->email = $request->email;
            $job->st_date = $request->st_date;
            $job->st_time = $request->st_time;
            $job->ed_date = $request->ed_date;
            $job->ed_time = $request->ed_time;
            $job->updated_by = $request->user_id;
            $job->interview_status = 1;            

            // send mail here..
            /*$get_view_data['subject']    =   'Interview on:- '. $request->st_date;
            $get_view_data['view']       =   'mails.interview';
            $get_view_data['user']       =   [
                'name' =>  $job->user->name,
                'message' => 'Here by, I am sending you details for your interview for the position of'.$job->job->title,
                'st_date' => $job->st_date,
                'st_time' => $job->st_time,
                'meating_url' => $request->meating_url,
                'user_name' => $job->user->name,
                'ed_time' => $job->ed_time,
                'interviewer_name' => $job->project->contact->first_name ?? '',
                'to_email' => $request->email ?? '',
                'frm_email' => $request->fr_email ?? '',
            ];*/

            $ccEmails = [$request->fr_email, $request->email];
            if($request->has('cc_email') && $request->filled('cc_email')){
                $cc = explode(',', $request->cc_email);
                $ccEmails = array_merge($cc, $ccEmails);
            }

            // another way
            $user = [
                'name' =>  $job->user->name,
                'message' => 'Here by, I am sending you details for your interview for the position of'.$job->job->title,
                'st_date' => $job->st_date,
                'st_time' => $job->st_time,
                'meating_url' => $request->meating_url,
                'user_name' => $job->user->name,
                'ed_time' => $job->ed_time,
                'interviewer_name' => $job->project->contact->first_name ?? '',
                'to_email' => $request->email ?? '',
                'frm_email' => $request->fr_email ?? '',
            ];

            $html = view('mails.interview', compact('user'))->render();
            $js_data = [
                'html' => $html,
                'to_mail' => implode(',', $ccEmails),
                'subject' => 'Interview on:- '. $request->st_date
            ];
            
            try{
                // $mail = Mail::to($request->email)->cc($ccEmails)->send(new MainTemplate( $get_view_data ));
                $job->save();
                $response = sendMail($js_data);
                $code = json_decode($response);
                if($code->flag){
                    return response()->json(['message' => 'Mail send successfully.', 'status' => 201], 201);
                }
                return response()->json(['message' => 'Mail not sent successfully.', 'status' => 201], 201);
            }catch(\Swift_TransportException $transportExp){
                return response()->json(['message' => 'Mail not sent successfully.', 'status' => 201], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * 
     */
    public function changeInterviewStatus($job_id, $status_id, $user_id){
        $job = JobManageMent::where('id', $job_id)->first();
        $job->interview_status = $status_id;
        $job->updated_by = $user_id;
        $job->save();
        return redirect()->back()->with('success', 'Action completed.');
    }

    /**
     * send offer letter
     * cody by sanjay
     */
    public function storeOfferLetter(Request $request){
        try {
            $arr = [
                'id_card' => 'required|image|mimes:jpeg,png,jpg',
                'offer_letter' => 'required|max:10000|mimes:doc,docx,pdf',
                'office_location' => 'required',
                'person_name' => 'required',
                'person_contact' => 'required|numeric|digits_between:10,15',                
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $job = JobManageMent::where('id', $request->job_mg_id)->first();
            $job->office_location = $request->office_location;
            $job->person_name = $request->person_name;
            $job->person_contact = $request->person_contact;

            if ($request->file('id_card')) {
                $imagePath = $request->file('id_card');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $imageName = str_replace(' ', '-', $imageName);
                $request->id_card->move(public_path($this->upload_path), $imageName);
                $job->id_card = $this->upload_path . '' . $imageName;
            }

            if ($request->file('offer_letter')) {
                $imagePath = $request->file('offer_letter');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $imageName = str_replace(' ', '-', $imageName);
                $request->offer_letter->move(public_path($this->upload_path), $imageName);
                $job->offer_letter = $this->upload_path . '' . $imageName;
            }

            $job->selection_status = 1;
            $job->updated_by = $request->user_id;            

            // send mail here..
            /*$get_view_data['subject']    =   'Confirmation';
            $get_view_data['view']       =   'mails.user-resume-mail';
            $get_view_data['user']       =   [
                'name' =>  'Buddy',
                'message' => 'Hereby attaching four cv for you reference.',
            ];*/

            // another way
            $user = [
                'name' =>  'Buddy',
                'message' => 'Hereby attaching four cv for you reference.',
            ];

            $html = view('mails.user-resume-mail', compact('user'))->render();
            $js_data = [
                'html' => $html,
                'to_mail' => $job->user->email,
                'subject' => 'Confirmation'
            ];

            try{
                // $mail = Mail::to($job->user->email)->send(new MainTemplate( $get_view_data ));
                $job->save();
                $response = sendMail($js_data);
                $code = json_decode($response);
                if($code->flag){
                    return response()->json(['message' => 'Mail send successfully.', 'status' => 201], 201);
                }
                return response()->json(['message' => 'Mail not sent successfully.', 'status' => 201], 201);
            }catch(\Swift_TransportException $transportExp){
                return response()->json(['message' => 'Mail not sent successfully.', 'status' => 201], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * create a user
     */
    public function storeUserFromContact($id){
        $contact = Contact::findOrFail($id);
        $ex_user = User::where('email', $contact->email)->first();
        if($ex_user){
            return redirect()->back()->with('error', 'That user is already exists in users.');
        }

        $pass = randomPassword();
        $user = new User;
        $user->name = $contact->first_name.' '.$contact->last_name;
        $user->first_name = $contact->first_name;
        $user->last_name = $contact->last_name;
        $user->email = $contact->email;
        $user->contact_number = $contact->phone;
        $user->password = Hash::make($pass);
        $user->role_id = '2';
        $user->status = '1';
        $user->save();

        // send mail here..
        /*$get_view_data['subject']    =   'User Confirmation';
        $get_view_data['view']       =   'mails.user-account';
        $get_view_data['user']       =   [
            'name' =>  $user->name,
            'email' =>  $user->email,
            'password' =>  $pass,
        ];*/

        // another way
        $user = [
            'name' =>  $user->name,
            'email' =>  $user->email,
            'password' =>  $pass,
        ];

        $html = view('mails.user-account', compact('user'))->render();
        $js_data = [
            'html' => $html,
            'to_mail' => $contact->email,
            'subject' => 'User Confirmation'
        ];

        try{
            // $mail = Mail::to($contact->email)->send(new MainTemplate( $get_view_data ));
            $response = sendMail($js_data);
            $code = json_decode($response);
            if($code->flag){
                return redirect()->back()->with('success', 'User Mail send successfully.');
            }
            return redirect()->back()->with('error', 'User Mail not send successfully.');            
        }catch(\Swift_TransportException $transportExp){
            return redirect()->back()->with('error', 'user create but Mail not sent successfully.');
        }
    }
}
