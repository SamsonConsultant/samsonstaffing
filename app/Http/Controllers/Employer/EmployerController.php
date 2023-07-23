<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Job;
use App\Models\Project;
use App\User;
use Auth;
use Config;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\IsValidPassword;

use Validator;

class EmployerController extends Controller
{
    protected $guard = 'employer';

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user = Auth::user();
        $contact = Contact::where('email', $user->email)->first();
        $projects = [];
        if(!empty($contact)){
            $projects = Project::where('contact_id', $contact->id)->get();
        }

        $jobs = [];
        if(!empty($contact)){
            $project_id = Project::where('contact_id', $contact->id)->pluck('id');
            if (!empty($projects)) {
                $jobs = Job::whereIn('project_id', $project_id)->get();
            }
        }

        return view('pages.employer.dashboard',compact('projects','jobs'));
    }


    /**
     * Admin user update password
     * 12-Mar-22
     */
    public function passwordUpdate(Request $request){
        try {
            $arr = [];
            $arr['old_password'] = ['required', 'string'];
            $arr['password'] = ['required', 'string', 'confirmed', new isValidPassword()];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $user = Auth::user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->password)
                ])->save();

                return response()->json(['message' => 'Password has been updated successfully.', 'status' => 201], 201);
            } else {
                return response()->json(['message' => 'Old Password does not match.', 'status' => 200], 200);
            }            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }
}
