<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());

        return \response()->json([
            'success' => true,
            'message' => 'Record Added',
            'data' => []
        ]);
    }

    public function show(Employee $employee)
    {
    }

    public function edit(Employee $employee)
    {
    }

    public function update(Request $request, Employee $employee)
    {
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return \response()->json([
            'success' => true,
            'message' => 'Record Deleted',
            'data' => []
        ]);
    }
}
