<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{

    public function index()
    {
        //
        return Inertia::render('Employees/Index', [
            'department_id' => Request::get('department_id'),
            'employees' => Employee::orderBy('id', 'DESC')
                ->with('department')
                ->paginate(10)
                ->through(function ($employee) {
                    return [
                        'id' => $employee->id,
                        'name' => $employee->name,
                        'email' => $employee->email,
                        'department' => $employee->department->name ?? null,
                    ];
                }),

                'departments' => Department::orderBy('name')->get()
                ->transform(function ($d) {
                    return [
                        'id' => $d->id,
                        'label' =>  $d->name
                    ];
                })
        ]);
    }


    public function create()
    {

        return Inertia::render('Employees/Create', [
            'departments' => Department::orderBy('name')->get()
                ->transform(function ($d) {
                    return [
                        'id' => $d->id,
                        'label' =>  $d->name
                    ];
                })
        ]);
    }

    public function store(Request $request)
    {
        $employee = Employee::create($request->all());

        return redirect()->route('employees.index')->with('success','Created successfully');

    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        //
        return Inertia::render('Employees/Edit', [
            'employee' => [
                'id' => $employee->id,
                'department_id' => $employee->department->id,
                'name' => $employee->name,
                'email' => $employee->email,
            ],
            'departments' => Department::orderBy('name')->get()
                ->transform(function ($d) {
                    return [
                        'id' => $d->id,
                        'label' =>  $d->name
                    ];
                })
        ]);
    }

    public function update(Request $request, Employee $employee)
    {

        $employee->update($request->all());
        return Redirect::route('employees.index')->with('success', 'Employee Updated.');
    }

    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return Redirect::back()->with('success', 'Employee deleted.');
    }
}

