<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Staff;
use Illuminate\Http\Request;

class CommissionController extends Controller
{

    public function index()
    {
        $commissions = Commission::with('staff')->latest()->get();

        return view('admin.commission.index', compact('commissions'));
    }


    public function create()
    {
        $staff = Staff::all();

        return view('admin.commission.create', compact('staff'));
    }


    public function store(Request $request)
    {

        $request->validate([

            'staff_id'=>'required',
            'total_sales'=>'required|numeric',
            'commission_percent'=>'required|numeric',

        ]);


        $amount = ($request->total_sales * $request->commission_percent) / 100;


        Commission::create([

            'staff_id'=>$request->staff_id,
            'total_sales'=>$request->total_sales,
            'commission_percent'=>$request->commission_percent,
            'commission_amount'=>$amount,

        ]);


        return redirect()
        ->route('commission.index')
        ->with('success','Commission Added Successfully');

    }



    public function destroy($id)
    {

        Commission::findOrFail($id)->delete();

        return back()
        ->with('success','Commission Deleted');

    }

}