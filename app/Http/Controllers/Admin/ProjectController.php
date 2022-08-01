<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProjectRequest;
use App\Http\Services\ImageUpload;
use App\Models\Project;
use System\Request\Request;

class ProjectController extends AdminController
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'DESC')->get();

        return view('admin.project.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function store()
    {
        $request = new ProjectRequest();
        $inputs = $request->all();
        $inputs['image'] = ImageUpload::dateFormatUploadAndFit('image', 'project', 800, 499);
        Project::create($inputs);

        return redirect(route('admin.project.index'));
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('admin.project.edit', compact('project'));
    }

    public function update($id)
    {
        $request = new ProjectRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        $image = ImageUpload::dateFormatUploadAndFit('image', 'project', 800, 499);
        if ($image) {
            $inputs['image'] = $image;
        }
        Project::update($inputs);

        return redirect(route('admin.project.index'));
    }

    public function destroy($id)
    {
        new Request();
        Project::delete($id);

        return back();
    }
}
