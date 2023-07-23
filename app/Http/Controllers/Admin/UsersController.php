<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
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
        $users = User::all();
        $template = 'user-list';
        return view('pages.admin.index', compact('users','template'));
    }

    public function create(){
        $roles = Role::all()->pluck('role_name', 'id');

        $template = 'user-create';
        return view('pages.admin.index', compact('roles','template'));
    }

    public function store(StoreUserRequest $request)
    {        
        $user = User::create($request->all());
        $user->roles()->sync($request->input('role_id', []));

        return redirect()->route('admin.users.index')->with('success', 'Action completed.');
    }

    public function edit(User $user){
        $roles = Role::all()->pluck('role_name', 'id');
        $user->load('roles');

        $template = 'user-edit';
        return view('pages.admin.index', compact('roles','template', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user){
        $user->update($request->all());
        $user->roles()->sync($request->input('role_id', []));

        return redirect()->route('admin.users.index')->with('success', 'Action completed.');
    }

    public function show(User $user){
        $user->load('roles');

        $template = 'user-show';
        return view('pages.admin.index', compact('template', 'user'));
    }

    public function destroy(User $user){
        $user->forceDelete();
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request){
        User::whereIn('id', request('ids'))->forceDelete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
