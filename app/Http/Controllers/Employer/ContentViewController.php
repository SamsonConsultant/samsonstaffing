<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\Country;
use App\Models\State;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Job;
use App\Models\Location;

use App\Models\JobManageMent;

use Request as RequestsUrl;
use Config;
use Auth;
use DB;
use Validator;

class ContentViewController extends Controller
{
    protected $guard = 'employer';
    public $per_page = 50;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['employer','auth']);
    }

    /**
     * Show the companies dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function companyIndex()
    {
        $user = Auth::user();
        $companies = Company::where('created_by', $user->id)->get();
        
        return view('pages.employer.company.cm-list',compact('companies'));
    }


    /**
     * Show the companies create blade.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function companyCreate(Request $request, $id = null)
    {
        $user = Auth::user();
        $country = Country::all();
        $state = State::all();
        $posts = get_post_data('account_type');

        if(!empty($id)){
            $company = Company::where('id', $id)->first();
            return view('pages.employer.company.cm-add-edit', compact('country', 'state','posts', 'company'));
        }
        
        return view('pages.employer.company.cm-add-edit', compact('country', 'state','posts'));
    }

    public function companyShow($id){
        $company = Company::findOrFail($id);

        return view('pages.employer.company.cm-show', compact('company'));
    }

    #########################################################################
    #
    ##############################################################################

    /**
     * Show the contact dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactsIndex()
    {
        $user = Auth::user();
        $contacts = Contact::where('created_by', $user->id)->get();
        
        return view('pages.employer.contact.con-list',compact('contacts'));
    }

    /**
     * Show the contact create blade.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactsCreate(Request $request, $id = null)
    {
        $user = Auth::user();
        $country = Country::all();
        $state = State::all();
        $companies = Company::where('status', 1)->get();

        if(!empty($id)){
            $contact = Contact::where('id', $id)->first();
            return view('pages.employer.contact.con-add-edit', compact('country', 'state','companies', 'contact'));
        }
        
        return view('pages.employer.contact.con-add-edit', compact('country','companies'));
    }

    /**
     * show the contact info
     */
    public function contactsShow($id){
        $contact = Contact::findOrFail($id);

        return view('pages.employer.contact.con-show', compact('contact'));
    }

    #########################################################################
    #
    ##############################################################################

    /**
     * Show the project dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function projectsIndex()
    {
        $user = Auth::user();
        $contact = Contact::where('email', $user->email)->first();
        $projects = [];
        if(!empty($contact)){
            $projects = Project::where('contact_id', $contact->id)->get();
        }
        
        return view('pages.employer.project.pr-list',compact('projects'));
    }

    /**
     * Show the project create blade.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function projectsCreate(Request $request, $id = null)
    {
        $user = Auth::user();
        $country = Country::all();
        $companies = Company::where('status', 1)->get();
        $contacts = Contact::where('status', 1)->get();

        if(!empty($id)){
            $projects = Project::where('id', $id)->first();
            return view('pages.employer.project.pr-add-edit', compact('projects', 'companies', 'contacts'));
        }
        
        return view('pages.employer.project.pr-add-edit', compact('companies', 'contacts'));
    }

    /**
     * show the project info
     */
    public function projectsShow($id){
        $projects = Project::findOrFail($id);

        return view('pages.employer.project.pr-show', compact('projects'));
    }

    #########################################################################
    #
    ##############################################################################

    /**
     * Show the project dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function jobsIndex(){
        $user = Auth::user();
        $contact = Contact::where('email', $user->email)->first();
        $jobs = [];
        if(!empty($contact)){
            $projects = Project::where('contact_id', $contact->id)->pluck('id');
            if (!empty($projects)) {
                // code...
                $jobs = Job::whereIn('project_id', $projects)->get();
            }
        }        
        
        return view('pages.employer.job.job-list',compact('jobs'));
    }

    /**
     * Show the project create blade.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function jobsCreate(Request $request, $id = null){
        $user = Auth::user();
        $companies = Company::where('status', 1)->get();
        $projects = Project::where('status', 1)->get();

        $skills = get_post_data('key_skills');
        $role_category = get_post_data('role_category');
        $employement_type = get_post_data('employement_type');
        $area = get_post_data('area');
        $industry_type = get_post_data('industry_type');
        $education = get_post_data('education');
        $candidate_profile = get_post_data('candidate_profile');
        $roles = get_post_data('roles');
        $experience = get_post_data('experience');
        $location = Location::all();

        if(!empty($id)){
            $job = Job::where('id', $id)->first();
            return view('pages.employer.job.job-add-edit', compact('companies', 'projects', 'job', 'experience','roles','candidate_profile','education','industry_type','area','employement_type','role_category','skills','location'));
        }
        
        return view('pages.employer.job.job-add-edit', compact('companies', 'projects', 'experience','roles','candidate_profile','education','industry_type','area','employement_type','role_category','skills','location'));
    }

    /**
     * show the project info
     */
    public function jobsShow($id){
        $job = Job::findOrFail($id);

        return view('pages.employer.job.job-show', compact('job'));
    }

    /**
     * 08-nov-2022
     * get all the job management data
     */
    public function jobManageMentContent(){
        $user = Auth::user();
        $jobs = JobManageMent::where('created_by', $user->id)->get();

        $country = Country::orderBy('name', 'asc')->get();
        $state = State::orderBy('name', 'asc')->get();
        $all_job = Job::orderBy('title', 'asc')->get();

        return view('pages.employer.job-management', compact('jobs','country', 'state', 'all_job'));   
    }

    /**
     * 08-nov-2022
     * get all the contact form data
     */
    public function getProjectView($job_id, $project_id){
        $user = Auth::user();

        $project = Project::where('id', $project_id)->first();
        $job = Job::where('id', $job_id)->first();

        $related_jobs = JobManageMent::where('job_id', $job_id)->where('created_by', $user->id)->get();

        $country = Country::orderBy('name', 'asc')->get();
        $state = State::orderBy('name', 'asc')->get();
                
        return view('pages.employer.project-view', compact('project', 'job', 'related_jobs', 'country', 'state'));   
    }

    /**
     * 17-dec-2022
     * get all the job stage one
     */
    public function getJobStageContent(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $user = Auth::user();
        $contact = Contact::where('email', $user->email)->first();
        $jobs_id = '';
        if(!empty($contact)){
            $projects = Project::where('contact_id', $contact->id)->pluck('id');
            if (!empty($projects)) {
                $jobs_id = Job::whereIn('project_id', $projects)->pluck('id');
            }
        }

        $country = Country::orderBy('name', 'asc')->get();
        $state = State::orderBy('name', 'asc')->get();
        $all_job = Job::orderBy('title', 'asc')->get();
        $account = Company::orderBy('title', 'asc')->get();
        $contact = Contact::orderBy('first_name', 'asc')->get();
        $project = Project::orderBy('title', 'asc')->get();

        $status = getStageStatusType($template);
        $get_order = (new JobManageMent)->newQuery();
        $get_order->join('users AS pe', 'job_manage_ments.user_id', '=', 'pe.id');
        $get_order->select('job_manage_ments.*', 'pe.id as u_id');
        if($request->all()){
            if ($request->has('s') && $request->filled('s')) {
                $get_order->where('pe.name' , 'like' , '%'.$request->s.'%');
                $get_order->orWhere('pe.email' , 'like' , '%'.$request->s.'%');
            }

            if ($request->has('a') && $request->filled('a')) {
                $ac = Company::where('id', $request->a)->pluck('id');
                $jb = Job::whereIn('client_id', $ac)->pluck('id');
                $get_order->whereIn('job_manage_ments.job_id' , $jb);
            }

            if ($request->has('c') && $request->filled('c')) {
                $cc = Contact::where('id', $request->c)->pluck('id');
                $pr = Project::whereIn('contact_id', $cc)->pluck('id');
                $jb = Job::whereIn('project_id', $pr)->pluck('id');
                $get_order->whereIn('job_manage_ments.job_id' , $jb);
            }

            if ($request->has('p') && $request->filled('p')) {
                $pr = Project::where('id', $request->p)->pluck('id');
                $jb = Job::whereIn('project_id', $pr)->pluck('id');
                $get_order->whereIn('job_manage_ments.job_id' , $jb);
            }
        }

        $jobs = [];
        if(!empty($jobs_id)){
            $jobs = $get_order->where('job_manage_ments.status', $status)->whereIn('job_id', $jobs_id)->orderBy('job_manage_ments.id', 'DESC')->paginate($this->per_page);
        }

        return view('pages.employer.stage', compact('template', 'segments', 'jobs','country', 'state', 'all_job', 'account', 'contact', 'project'));   
    }
}
