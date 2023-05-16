<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ExperienceRequest;
use App\Models\Experience;
use System\Request\Request;

class ExperienceController extends AdminController
{
    public function index()
    {
        $experiences = Experience::orderBy('created_at', 'DESC')->get();

        return view('admin.experience.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experience.create');
    }

    public function store()
    {
        $request = new ExperienceRequest();
        $inputs = $request->all();
        Experience::create($inputs);

        return redirect(route('admin.experience.index'));
    }

    public function edit($id)
    {
        $experience = Experience::find($id);

        return view('admin.experience.edit', compact('experience'));
    }

    public function update($id)
    {
        $request = new ExperienceRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        Experience::update($inputs);

        return redirect(route('admin.experience.index'));
    }

    public function destroy($id)
    {
        new Request();
        Experience::delete($id);

        return back();
    }
}
