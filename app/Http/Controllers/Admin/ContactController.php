<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Company;
use App\Models\Country;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Auth;
use Gate;
use Validator;

class ContactController extends Controller
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
        $this->middleware('auth:admin')->except(['massDestroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $contacts = Contact::all();

        $template = 'contact-list';
        return view('pages.admin.index', compact('template', 'contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $companies = Company::where('status', 1)->get();
        $country = Country::all();

        $template = 'contact-create';
        return view('pages.admin.index', compact('template', 'companies', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            $arr = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:contacts,email',
                'phone' => 'required|numeric|digits:10|unique:contacts,phone',
                'phone_code' => 'required',
                'account_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $contact = new Contact();
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phone_code = $request->phone_code;
            $contact->phone = $request->phone;
            $contact->uid = $request->uid;
            $contact->detail = $request->detail ?? '';
            $contact->created_by = Auth::user()->id;
            $contact->account_id = $request->account_id;
            // $contact->account_detail = $request->account_detail;
            $contact->save();

            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $contact = Contact::findOrFail($id);

        $template = 'contact-show';
        return view('pages.admin.index', compact('template', 'contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $contact = Contact::findOrFail($id);
        $companies = Company::where('status', 1)->get();
        $country = Country::all();

        $template = 'contact-edit';
        return view('pages.admin.index', compact('template', 'contact', 'companies', 'country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact){
        try {
            $arr = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'phone' => 'required|numeric|digits:10',
                'phone_code' => 'required',
                'account_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phone_code = $request->phone_code;
            $contact->phone = $request->phone;
            $contact->uid = $request->uid;
            $contact->detail = $request->detail ?? '';
            $contact->account_id = $request->account_id;
            // $project->account_detail = $request->account_detail;
            $contact->save();

            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Contact::where('id', $id)->delete();
        return back();
    }

    public function massDestroy(MassDestroyCompanyRequest $request){
        Contact::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
