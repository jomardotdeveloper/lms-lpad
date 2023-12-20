<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        $students = Contact::where('is_student', true)->get();
        $teachers = Contact::where('is_teacher', true)->get();
        $subjects = Subject::all();
        return view('single-pages.admin-dashboard' , compact('sections', 'students', 'teachers', 'subjects'));
    }
}
