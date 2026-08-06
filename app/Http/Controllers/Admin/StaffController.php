<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // Staff List
    public function index()
    {
        $staff = Staff::latest()->get();

        return view('admin.staff.index', compact('staff'));
    }


    // Add Staff Form
    public function create(Request $request)
    {
        $position = $request->query('position', 'Stylist');

        return view('admin.staff.create', compact('position'));
    }


    // Save Staff
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'position' => 'required',
            'salary' => 'required|numeric',
        ]);

        Staff::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'salary' => $request->salary,
        ]);

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff added successfully.');
    }


    // Edit Form
    public function edit(string $id)
    {
        $staff = Staff::findOrFail($id);

        return view('admin.staff.edit', compact('staff'));
    }


    // Update Staff
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'position' => 'required',
            'salary' => 'required|numeric',
        ]);

        $staff = Staff::findOrFail($id);

        $staff->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'salary' => $request->salary,
        ]);

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff updated successfully.');
    }


    // Delete Staff
    public function destroy(string $id)
    {
        $staff = Staff::findOrFail($id);

        $staff->delete();

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff deleted successfully.');
    }
}