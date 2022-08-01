<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SkillRequest;
use App\Models\Skill;

class SkillController extends AdminController
{
    public function index()
    {
        $skills = Skill::orderBy('created_at', 'DESC')->get();

        return view('admin.skill.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skill.create');
    }

    public function store()
    {
        $request = new SkillRequest();
        $inputs = $request->all();
        Skill::create($inputs);

        return redirect(route('admin.skill.index'));
    }

    public function edit($id)
    {
        $skill = Skill::find($id);

        return view('admin.skill.edit', compact('skill'));
    }

    public function update($id)
    {
        $request = new SkillRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        Skill::update($inputs);

        return redirect(route('admin.skill.index'));
    }

    public function destroy($id)
    {
        Skill::delete($id);

        return back();
    }
}
