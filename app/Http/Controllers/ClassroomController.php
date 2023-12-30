<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\StudentGrade;
use App\Models\Test;
use App\Models\Topic;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();

        if(auth()->user()->contact->is_student)
            $classrooms = auth()->user()->contact->classrooms;
        if(auth()->user()->contact->is_teacher)
            $classrooms = auth()->user()->contact->teacherClassrooms;

        return view('classroom.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $randomCode4Char = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
        $image = $request->file('image_src');
        while(true) {
            $subject = Classroom::where('code', $randomCode4Char)->first();
            if(!$subject) {
                break;
            }
        }

        $path = $this->uploadFile($request, 'image_src', 'classroom');

        $classroom = Classroom::create([
            'name' => $request->name,
            'code' => $randomCode4Char,
            'teacher_id' => auth()->user()->contact->id,
            'description' => $request->description,
            'image_src' => $path,
        ]);

        if(auth()->user()->contact->is_admin)
            $this->createLog('Classroom created', auth()->user(), true);

        return redirect()->route('classrooms.index')->with('success', 'Classroom created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        return view('classroom.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        return view('classroom.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {

        $data = $request->all();

        if($request->hasFile('image_src')) {
            $path = $this->uploadFile($request, 'image_src', 'classroom');
            $data['image_src'] = $path;
        }

        $classroom->update($data);

        if(auth()->user()->contact->is_admin)
            $this->createLog('Classroom updated', auth()->user(), true);

        return redirect()->route('classrooms.index')->with('success', 'Classroom updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        if(auth()->user()->contact->is_admin)
            $this->createLog('Classroom deleted', auth()->user(), true);
    }

    public function enroll(Request $request)
    {
        $code = $request->code;

        $classroom = Classroom::where('code', $code)->first();

        if(!$classroom) {

            return back()->withErrors([
                'email' => 'Classroom not found.',
            ]);
        } else {
            // check if student already enrolled

            $student = $classroom->students()->where('student_id', auth()->user()->contact->id)->first();

            if($student) {

            }

            $classroom->students()->attach(auth()->user()->contact->id);
            $classroomGrades = StudentGrade::create([
                'classroom_id' => $classroom->id,
                'student_id' => auth()->user()->contact->id,
            ]);
        }
        return redirect()->route('classrooms.index')->with('success', 'Student enrolled successfully.');
    }

    public function computeGrades(Request $request) {
        $classroom = Classroom::find($request->classroom_id);
        $tests = $classroom->topics->where('type', 'test')->all();

        if(count($tests) == 0) {
            return back()->withErrors([
                'email' => 'Cannot compute grade without test.',
            ]);
        }

        $students = $classroom->students;

        if(count($students) == 0) {
            return back()->withErrors([
                'email' => 'Cannot compute grade without students.',
            ]);
        }


        $test_names = $request->test_names;
        $test_percentages = $request->percentages;

        // ARRAY SEPARATED BY COMMA

        $test_names = explode(',', $test_names);
        $test_percentages = explode(',', $test_percentages);
        // dd($test_names, $test_percentages);

        if(count($test_names) != count($test_percentages)) {
            return back()->withErrors([
                'email' => 'Test names and percentages must be equal.',
            ]);
        }

        $tests = [];

        foreach($test_names as $test) {
            $cur = Topic::where('name', $test)->first();
            // $cur = $cur->test;
            if(!$cur) {
                return back()->withErrors([
                    'email' => 'Test not found.',
                ]);
            }

            array_push($tests, $cur->test);
        }

        $totalPercentage = 0;

        foreach($test_percentages as $percentage) {
            $totalPercentage += $percentage;
        }

        if($totalPercentage != 100) {
            return back()->withErrors([
                'email' => 'Total percentage must be 100.',
            ]);
        }

        foreach($students as $student) {
            $studentGrade = null;

            foreach($classroom->studentGrades as $grade) {
                if($grade->student_id == $student->id) {
                    $studentGrade = $grade;
                    break;
                }
            }

            $totalGrade = 70;
            $nonTotalGrade = 0;
            $curIndex = 0;
            foreach($tests as $test) {

                $testSubmissions = $test->testSubmissions->where('student_id', $student->id)->all();

                if(count($testSubmissions) > 0) {
                    $curScore = 0;
                    foreach($testSubmissions as $testSubmission) {
                        if($testSubmission->is_correct) {
                            $curScore += 1;
                        }
                        // $nonTotalGrade += $this->computeGrade($testSubmission->score, $test->items->count(), $test->percentage);
                    }

                    $nonTotalGrade += $this->computeGrade($curScore, $test->items->count(), $test_percentages[$curIndex]);
                    // $nonTotalGrade += $this->computeGrade($testSubmission->score, $test->items->count(), $test->percentage);
                }

            }

            if ($nonTotalGrade >= 70) {
                $totalGrade = $nonTotalGrade;
            }


            if($studentGrade->quarter_1 == null) {
                $studentGrade->update([
                    'quarter_1' => $totalGrade,
                ]);
            } else if($studentGrade->quarter_2 == null) {
                $studentGrade->update([
                    'quarter_2' => $totalGrade,
                ]);
            } else if($studentGrade->quarter_3 == null) {
                $studentGrade->update([
                    'quarter_3' => $totalGrade,
                ]);
            } else if($studentGrade->quarter_4 == null) {
                $studentGrade->update([
                    'quarter_4' => $totalGrade,
                ]);
            }
        }


        return redirect()->route('classrooms.show', $classroom->id)->with('success', 'Grades computed successfully.');

        // return redirect()->route('classrooms.show', $test->topic->classroom->id)->with('success', 'Grades computed successfully.');
    }

    private function computeGrade($studentScore, $totalScore, $percentage) {
        return ($studentScore / $totalScore) * $percentage;
    }
}
