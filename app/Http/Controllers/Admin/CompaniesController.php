<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Country;
use App\Models\State;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Auth;
use Validator;

class CompaniesController extends Controller
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

    public function index(){
        $companies = Company::all();

        $template = 'company-list';
        return view('pages.admin.index', compact('companies','template'));
    }

    public function create(){
        $template = 'company-create';
        $country = Country::all();
        $state = State::all();
        $posts = get_post_data('account_type');

        return view('pages.admin.index', compact('template', 'country', 'state','posts'));
    }

    public function store(StoreCompanyRequest $request){
        $arr = [
            'phone' => 'required|numeric|digits:10',
            'phone_code' => 'required',
            'account_type' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $arr);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $company = new Company();
        $company->title = $request->title;
        $company->uid = $request->uid;
        $company->account_type = $request->account_type;
        $company->customer_since = $request->customer_since;
        $company->country_id = $request->country_id ?? '';
        $company->state_id = $request->state_id ?? '';
        $company->city = $request->city ?? '';
        $company->zip_code = $request->zip_code ?? '';
        $company->phone_code = $request->phone_code ?? '';
        $company->phone = $request->phone ?? '';
        $company->address = $request->address ?? '';
        $company->detail = $request->detail ?? '';
        $company->created_by = Auth::user()->id;
        // $company->account_number = $request->account_number;
        $company->save();

        // return redirect()->route('admin.companies.index');
        return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);

    }

    public function edit(Company $company){
        $template = 'company-edit';
        $country = Country::all();
        $state = State::all();
        $posts = get_post_data('account_type');

        return view('pages.admin.index', compact('company','template', 'country', 'state','posts'));
    }

    public function update(UpdateCompanyRequest $request, Company $company){
        $arr = [
            'phone' => 'required|numeric|digits:10',
            'phone_code' => 'required',
            'account_type' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $arr);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $company->title = $request->title;
        $company->uid = $request->uid;
        $company->account_type = $request->account_type;
        $company->customer_since = $request->customer_since;
        $company->country_id = $request->country_id ?? '';
        $company->state_id = $request->state_id ?? '';
        $company->city = $request->city ?? '';
        $company->zip_code = $request->zip_code ?? '';
        $company->phone_code = $request->phone_code ?? '';
        $company->phone = $request->phone ?? '';
        $company->address = $request->address ?? '';
        $company->detail = $request->detail ?? '';
        // $company->account_number = $request->account_number;
        $company->save();

        return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
    }

    public function show(Company $company){
        $template = 'company-show';
        return view('pages.admin.index', compact('company','template'));
    }

    public function destroy(Company $company){
        $company->delete();
        return back();
    }

    public function massDestroy(MassDestroyCompanyRequest $request){
        Company::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
