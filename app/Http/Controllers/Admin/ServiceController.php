<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;

class ServiceController extends AdminController
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'DESC')->get();

        return view('admin.service.index', compact('services'));
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store()
    {
        $request = new ServiceRequest();
        $inputs = $request->all();
        Service::create($inputs);

        return redirect(route('admin.service.index'));
    }

    public function edit($id)
    {
        $service = Service::find($id);

        return view('admin.service.edit', compact('service'));
    }

    public function update($id)
    {
        $request = new ServiceRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        Service::update($inputs);

        return redirect(route('admin.service.index'));
    }

    public function destroy($id)
    {
        Service::delete($id);

        return back();
    }
}
