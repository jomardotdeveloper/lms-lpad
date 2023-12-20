<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('subject.create' , compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $randomCode4Char = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);

        while(true) {
            $subject = Subject::where('code', $randomCode4Char)->first();
            if(!$subject) {
                break;
            }
        }

        $subject = Subject::create([
            'name' => $request->name,
            'code' => $randomCode4Char,
            'contact_id' => auth()->user()->contact->id,
            'section_id' => $request->section_id,
            'subject_code' => $request->subject_code,
            'number_of_units' => $request->number_of_units,
            'subject_description' => $request->subject_description,
        ]);

        if(auth()->user()->contact->is_admin)
            $this->createLog('Subject created', auth()->user(), true);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $sections = Section::all();
        return view('subject.edit', compact('subject' , 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->update([
            'name' => $request->name,
            'section_id' => $request->section_id,
            'subject_code' => $request->subject_code,
            'number_of_units' => $request->number_of_units,
            'subject_description' => $request->subject_description,
        ]);

        if(auth()->user()->contact->is_admin)
            $this->createLog('Subject updated', auth()->user(), true);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        if(auth()->user()->contact->is_admin)
            $this->createLog('Subject deleted', auth()->user(), true);
    }
}
