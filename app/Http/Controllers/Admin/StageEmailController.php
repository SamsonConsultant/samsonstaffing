<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStageEmailRequest;
use App\Http\Requests\UpdateStageEmailRequest;
use Illuminate\Http\Request;
use App\Models\StageEmail;

class StageEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stage_emails = StageEmail::all();
        $template = 'stage-email-list';
        return view('pages.admin.index', compact('template','stage_emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = 'stage_email-create';
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
        $values = $request->except('_token');
        $stage_email = new StageEmail();
        $stage_email->email = $values['email'];
        $stage_email->save();

        return redirect()->route('admin.stage_email.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StageEmail $stage_email)
    {
        $template = 'stage-email-show';

        return view('pages.admin.index', compact('stage_email', 'template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, StageEmail $stage_email)
    {
        $template = 'stage-email-edit';
        return view('pages.admin.index', compact('stage_email', 'template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStageEmailRequest $request, StageEmail $stage_email)
    {
        $values = $request->except('_token');
        $stage_email->email = $values['email'];
        $stage_email->save();

        return redirect()->route('admin.stage_email.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StageEmail $stage_email)
    {
        $stage_email->delete();

        return back();
    }

    public function massDestroy(MassDestroyStageEmailRequest $request)
    {
        StageEmail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    
}
