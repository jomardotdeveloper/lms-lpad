<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Item;
use App\Models\Test;
use App\Models\TestSubmission;
use App\Models\Topic;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classroom = Classroom::find($_GET['classroom_id']);
        return view('test.create' , compact('classroom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'questions' => 'required',
            'answers' => 'required',
            'types' => 'required',
        ]);


        $data = $request->all();
        $data['type'] = "test";
        $topic = Topic::create($data);

        $test = Test::create([
            'topic_id' => $topic->id,
        ]);


        $questions = $request->questions;
        $answers = $request->answers;
        $types = $request->types;


        for($i = 0; $i < count($questions); $i++) {
            $itemData = [];

            $itemData['name'] = $questions[$i];
            $itemData['answer'] = $answers[$i];

            if($types[$i] == "multiple_choice") {
                $itemData['choice_a'] = $request->choiceAs[$i];
                $itemData['choice_b'] = $request->choiceBs[$i];
                $itemData['choice_c'] = $request->choiceCs[$i];
                $itemData['choice_d'] = $request->choiceDs[$i];
            }


            $itemData['test_id'] = $test->id;

            $item = Item::create($itemData);
        }
        return redirect()->route('classrooms.show', $request->classroom_id)->with('success', 'Test created successfully.');
    }

    public function submit(Request $request) {
        $itemSubmissions = [];
        $test = Test::find($request->test_id);
        foreach($request->all() as $key => $value) {
            if($key != "_token" && $key != "test_id") {
                $item = Item::find($key);

                $data = [
                    "test_id" => $request->test_id,
                    "student_id" => auth()->user()->contact->id,
                    "item_id" => $key,
                    "answer" => $value,
                    "is_correct" => $item->answer == $value ? true : false
                ];

                array_push($itemSubmissions, $data);

            }
        }

        foreach($itemSubmissions as $itemSubmission) {
            TestSubmission::create($itemSubmission);
        }

        return redirect()->route('classrooms.show', $test->topic->classroom->id)->with('success', 'Test submitted successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        $classroom = Classroom::find($_GET['classroom_id']);
        $items = $test->items;


        $multiple_choices = [];
        $identifications = [];
        $true_or_falses = [];

        foreach($items as $item) {
            $type = $this->getType($item);
            if($type == "multiple_choice") {
                array_push($multiple_choices, $item);
            } else if($type == "identification") {
                array_push($identifications, $item);
            } else if($type == "true_or_false") {
                array_push($true_or_falses, $item);
            }
        }




        return view('test.show', compact('test' , 'classroom' , 'multiple_choices' , 'identifications' , 'true_or_falses'));
    }

    private function getType($item) {
        if ($item->choice_a != null) {
            return "multiple_choice";
        }

        if($item->answer == "True" || $item->answer == "False") {
            return "true_or_false";
        }

        return "identification";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        $testSubmissions = TestSubmission::where('test_id', $test->id)->get();

        $classroom = Classroom::find($_GET['classroom_id']);

        return view('test.edit', compact('test' , 'classroom' , 'testSubmissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $topic = Topic::find($test->topic_id);

        $test->delete();
        $topic->delete();
    }


}
