<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Display all services
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    // Show Add Service Form
    public function create()
    {
        return view('admin.services.create');
    }

    // Save Service
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable',
            'status' => 'required'
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service Added Successfully.');
    }

    // Show Single Service (agar show.blade.php hai)
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    // Show Edit Form
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Update Service
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_name' => 'required|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable',
            'status' => 'required'
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service Updated Successfully.');
    }

    // Delete Service
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service Deleted Successfully.');
    }
}