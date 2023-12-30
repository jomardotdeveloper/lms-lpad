<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
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
        $type = $_GET['type'];

        return view('topic.create' , compact('classroom', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($request->type == "video") {
            // $data = $request->all();
            $path = $this->uploadFile($request, 'video_src', 'topic');
            $data['video_src'] = $path;
        } else if($request->type == "file") {
            // $data = $request->all();
            $path = $this->uploadFile($request, 'file_src', 'topic');
            $data['file_src'] = $path;
        }

        $topic = \App\Models\Topic::create($data);

        return redirect()->route('classrooms.show', $request->classroom_id)->with('success', 'Topic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        $classroom = Classroom::find($_GET['classroom_id']);
        $type = $_GET['type'];
        return view('topic.edit', compact('topic' , 'classroom', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $data = $request->all();

        if($request->type == "video") {
            if($request->hasFile('video_src')) {
                $path = $this->uploadFile($request, 'video_src', 'topic');
                $data['video_src'] = $path;
            }
        } else if($request->type == "file") {
            if($request->hasFile('file_src')) {
                $path = $this->uploadFile($request, 'file_src', 'topic');
                $data['file_src'] = $path;
            }
        }

        $topic->update($data);

        return redirect()->route('classrooms.show', $request->classroom_id)->with('success', 'Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
    }
}
