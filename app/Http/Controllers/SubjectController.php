<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Contact;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SubjectStudent;
use App\Models\SubjectTopic;
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
        $contacts = Contact::where('is_student', true)->get();
        return view('subject.show', compact('subject' , 'contacts'));
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

    public function addStudent(Request $request, Subject $subject)
    {
        SubjectStudent::create([
            'subject_id' => $subject->id,
            'contact_id' => $request->contact_id,
        ]);

        return redirect()->route('subjects.show', $subject)->with('success', 'Student added to subject successfully.');
    }

    public function addSubjectTopic(Request $request, Subject $subject)
    {
        $data = $request->all();
        if($request->hasFile('video_src')){

            $data['video_src'] = $this->uploadFile($request, 'video_src', 'videos');
        } else if($request->hasFile('file_src')){
            $data['file_src'] = $this->uploadFile($request, 'file_src', 'files');
        }

        $data['subject_id'] = $subject->id;

        SubjectTopic::create($data);

        return redirect()->route('subjects.show', $subject)->with('success', 'Topic added to subject successfully.');
    }

    public function showAllTopics(Subject $subject)
    {
        $topics = SubjectTopic::where('subject_id', $subject->id)->get();
        return view('subject.show-all', compact('subject', 'topics'));
    }

    public function createExam(Subject $subject)
    {
        return view('subject.create-exam', compact('subject'));
    }

    public function viewEditQuestion(Subject $subject, Exam $exam, Question $question)
    {
        // dd($exam->name);
        return view('subject.edit-question', compact('subject', 'exam', 'question'));
    }

    public function saveQuestion(Request $request, Subject $subject, Exam $exam, Question $question)
    {
        $choices = $request->choice;
        $correct = $request->is_correct;
        // dd($exam->id);
        $question->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'type' => $request->type,
        ]);

        for($i = 0; $i < count($choices); $i++) {
            Choice::create([
                'name' => $choices[$i],
                'is_correct' => $correct[$i] == "0" ? false : true,
                'question_id' => $question->id,
            ]);
        }

        return redirect()->route('subjects.show-exam', [$subject, $exam])->with('success', 'Question updated successfully.');
    }



    public function addExam(Request $request, Subject $subject)
    {
        $data = $request->all();
        $data['subject_id'] = $subject->id;

        $topic = SubjectTopic::create($data);

        $exam = Exam::create([
            'subject_topic_id' => $topic->id,
            'percentage' => $request->percentage,
        ]);


        $number_of_questions = $request->number_of_question;

        for($i = 0; $i < $number_of_questions; $i++) {
            Question::create([
                'question' => 'N/A',
                'answer' => 'N/A',
                'exam_id' => $exam->id,
                'type' => 'N/A',
            ]);
        }

        return redirect()->route('subjects.show', $subject)->with('success', 'Exam added to subject successfully.');
    }

    public function showExam(Subject $subject, Exam $exam)
    {
        $questions = Question::where('exam_id', $exam->id)->get();
        return view('subject.show-exam', compact('subject', 'exam', 'questions'));
    }
}
