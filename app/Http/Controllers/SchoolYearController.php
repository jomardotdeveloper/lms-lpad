<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolYears = SchoolYear::all();
        return view('school-year.index', compact('schoolYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school-year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:school_years,name']);
        SchoolYear::create($request->all());

        $this->createLog('School year created', auth()->user(), true);
        return redirect()->route('school-years.index')->with('success', 'School year created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolYear $schoolYear)
    {
        return view('school-year.show', compact('schoolYear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolYear $schoolYear)
    {
        return view('school-year.edit', compact('schoolYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolYear $schoolYear)
    {
        $request->validate(['name' => 'required|unique:school_years,name,' . $schoolYear->id]);
        $schoolYear->update($request->all());

        $this->createLog('School year updated', auth()->user(), true);
        return redirect()->route('school-years.index')->with('success', 'School year updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolYear $schoolYear)
    {
        $schoolYear->delete();
        $this->createLog('School year deleted', auth()->user(), true);
        // return redirect()->route('school-years.index')->with('success', 'School year deleted successfully.');
    }


}
