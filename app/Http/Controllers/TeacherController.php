<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller
{

    public function index()
    {
        return Inertia::render('Teachers/Index', [
            'teachers' => Teacher::orderBy('id', 'DESC')
                ->with('department')
                ->paginate(10)
                ->through(function ($teacher) {
                    return [
                        'id' => $teacher->id,
                        'name' => $teacher->name,
                        'email' => $teacher->email,
                        'department' => $teacher->department->name ?? null,
                    ];
                })
        ]);

    }


    public function create()
    {
        return Inertia::render('Teachers/Create', [
            'departments' => Department::orderBy('name')->get()
            ->transform(function ($department){
                return [
                    'id' => $department->id,
                'label' => $department->name
                ];

            })
    ]);
}


public function store(Request $request)
    {
       $teacher = Teacher::create(
            $request->all()
     );
        return redirect()->route('teachers.index')->with('success','Created successfully');
    }

    public function show(Teacher $teacher)
    {
        //
    }

    public function edit(Teacher $teacher)
    {

        return Inertia::render('Teachers/Edit', [
            'teacher' => [
                'id' => $teacher->id,
                'department_id' => $teacher->department->id,
                'name' => $teacher->name,
                'email' => $teacher->email,
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


/*    public function edit(Teacher $teacher)
    {
        return Inertia::render('Teachers/Edit', [
           'teacher' => [
            'name' => $teacher->name,
            'email' => $teacher->email,
            'department_id' => $teacher->department_id
           ],
           'departments' => Department::orderBy('name')->get()
           ->transform(function ($department){
            return [
                'id' => $department->id,
                'label' => $department->name
            ];
           })

        ]);

    } */


    public function update(Request $request, Teacher $teacher)
    {
        $newteacher = $teacher->update($request->all());
        return redirect()->route('teachers.index')->with('success','Updated successfully');
   }


    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success','Deleted successfully');

    }
}
