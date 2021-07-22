<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show(Student $student) {
        return response()->json($student,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $students = Student::where('name','like',"%$request->key%")
            ->orWhere('address','like',"%$request->key%")->get();

        return response()->json($students, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'lastname' => 'string|required',
            'address' => 'string|required',
            'contact' => 'numeric',
            'year' => 'string|required',
            'course' => 'string|required',
            'enroll' => 'date|required',
        ]);

        try {
            $student = Student::create($request->all());
            return response()->json($student, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Student $student) {
        try {
            $student->update($request->all());
            return response()->json($student, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Student $student) {
        $student->delete();
        return response()->json(['message'=>'Student deleted.'],202);
    }

    public function index() {
        $students = Student::orderBy('name')->get();
        return response()->json($students, 200);
    }
}
