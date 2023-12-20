<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schoolYears = SchoolYear::all();
        return view('section.create', compact('schoolYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Section::create($request->all());

        if(auth()->user()->contact->is_admin)
            $this->createLog('Section created', auth()->user(), true);

        return redirect()->route('sections.index')->with('success', 'Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('section.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $schoolYears = SchoolYear::all();
        return view('section.edit', compact('section', 'schoolYears'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $section->update($request->all());
        if(auth()->user()->contact->is_admin)
            $this->createLog('Section updated', auth()->user(), true);
        return redirect()->route('sections.index')->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        if(auth()->user()->contact->is_admin)
            $this->createLog('Section deleted', auth()->user(), true);
    }
}
