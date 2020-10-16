<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();
        return response()->json($employees ?? []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'department' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validator->errors()->first()]);
        }

        $employee = Employee::create($request->all());
        if ($employee) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'fail', 'message' => 'Something went wrong! Try again.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'department' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validator->errors()->first()]);
        }

        $employee = Employee::findOrFail($id);
        if ($employee->update($request->all())) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'fail', 'message' => 'Something went wrong! Try again.']);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->delete()) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'fail', 'message' => 'Something went wrong! Try again.']);
    }
}
