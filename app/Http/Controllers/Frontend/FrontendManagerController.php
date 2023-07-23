<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\User;
use App\Models\Post;
use App\Models\PostExtra;
use App\Models\Project;
use App\Models\Job;
use App\Models\ContactForm;
use App\Models\Country;
use App\Models\State;
use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

use Request as RequestsUrl;
use Validator;
use Config;
use Exception;
use Auth;

class FrontendManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        // $this->middleware(['guest', 'auth', 'user']);
    }

    /**
     * Display a home page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){        
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $reviews = get_post_data('review', $request);
        $projects = Project::take(4)->latest()->orderBy('title', 'asc')->get();
        
        return view('pages.frontend.index', compact('template', 'segments', 'reviews', 'projects'));
    }


    /**
     * Display a page content.
     *
     * @return \Illuminate\Http\Response
     */
    public function gePageContent(Request $request, $id){        
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        $page = Post::where('post_type', 'page')->where('id', base64_decode($id))->first();
        if(!$page){
            throw new Exception('Sorry page not found.');
        }

        return view('pages.frontend.page', compact('template', 'segments', 'page'));
    }

    /**
     * Display a blog content.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBlogs(Request $request){        
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        $blogs = get_post_data('blog', $request);
        return view('pages.frontend.blog', compact('template', 'segments', 'blogs'));
    }

    /**
     * Display a Single Blog content.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBlogContent(Request $request, $id){        
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        $page = Post::where('post_type', 'blog')->where('id', base64_decode($id))->first();
        if(!$page){
            throw new Exception('Sorry blog not found.');
        }

        return view('pages.frontend.html.single-blog', compact('template', 'segments', 'page'));
    }


    /**
     * Display a jobs content.
     *
     * @return \Illuminate\Http\Response
     */
    public function getJobsContent(Request $request){        
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        $all_data = $request->all();

        $cn_id = Company::all()->pluck('country_id');
        $st_id = Company::all()->pluck('state_id');
        $ct_id = Company::whereNotNull('city')->distinct()->pluck('city');

        $country = Country::whereIn('id', $cn_id)->get();
        $state = State::whereIn('id', $st_id)->get();

        $industry_type = get_post_data('industry_type');
        $area = get_post_data('area');

        $query = (new Job)->newQuery();
        if ($request->has('keyword') && $request->filled('keyword')) {
            $query->where('title', 'like', '%' .$request->keyword. '%');
        }

        if ($request->has('functional_area') && $request->filled('functional_area')) {
            $query->where('functional_area', 'like', '%' .$request->functional_area. '%');
        }

        if ($request->has('industry_type') && $request->filled('industry_type')) {
            $query->where('industry_type', 'like', '%' .$request->industry_type. '%');
        }

        if ($request->has('counrty') && $request->filled('counrty')) {
            $cnt_id = Company::where('country_id', $request->counrty)->distinct()->pluck('id');
            $query->whereIn('client_id',$cnt_id);
        }

        if ($request->has('state') && $request->filled('state')) {
            $snt_id = Company::where('state_id', $request->state)->distinct()->pluck('id');
            $query->whereIn('client_id',$snt_id);
        }

        if ($request->has('city') && $request->filled('city')) {
            $cty_id = Company::where('city', $request->city)->distinct()->pluck('id');
            $query->whereIn('client_id',$cty_id);
        }

        $jobs = $query->orderBy('id', 'DESC')->paginate(15);
        
        return view('pages.frontend.job-listing', compact('template', 'segments', 'jobs', 'all_data', 'country', 'state', 'ct_id', 'industry_type', 'area'));
    }

    /**
     * Display a job detail content.
     *
     * @return \Illuminate\Http\Response
     */
    public function getJobDetailContent(Request $request, $id){        
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        $query = (new Job)->newQuery();
        $job = $query->where('id', base64_decode($id))->first();

        $user = Auth::user();

        return view('pages.frontend.job-detail', compact('template', 'segments', 'job', 'user'));
    }


    public function storeContactForm(Request $request){
        try {
            $arr = [
                'name' => 'required',
                'email' => 'required|email',
                'company_name' => 'required',
                'phone_number' => 'required|numeric|digits:10',
                'message' => 'required',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $con = new ContactForm;
            $con->name = $request->name;
            $con->email = $request->email;
            $con->company_name = $request->company_name;
            $con->phone_number = $request->phone_number;
            $con->message = $request->message;
            $con->save();

            return response()->json(['message' => 'Thanks for your detail.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * Display a job detail content.
     *
     * @return \Illuminate\Http\Response
     */
    public function getApplyJob(Request $request){        
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
                
        return view('pages.frontend.apply-job', compact('template', 'segments'));
    }
}
