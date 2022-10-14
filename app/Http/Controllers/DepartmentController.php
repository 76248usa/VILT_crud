<?php

namespace App\Http\Controllers;

use App\Models\Department;
//use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::orderBy('name')->paginate(10);
        return Inertia::render('Departments/Index', [
            'departments' => $departments
        ]);
    }

    public function create()
    {
        return Inertia::render('Departments/Create');
    }

    public function store(DepartmentRequest $request)
    {

        $department = Department::create(
            $request->all()
     );

        return redirect()->route('departments.index')->with('success','Created successfully');
    }

    public function show(Department $department)
    {
        //
    }

    public function edit(Department $department)
    {
        return Inertia::render('Departments/Edit', [
        'department' => [
            'id' => $department->id,
            'name' => $department->name,
            'email' => $department->email,
            'phone' => $department->phone,
        ]

        ]);



    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->all());

        return redirect()->route('departments.index')->with('success','Department updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success','Department deleted successfully');
    }
}
