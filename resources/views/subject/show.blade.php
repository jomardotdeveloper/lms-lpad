@extends('layouts.master')
@section('title', 'View subject')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Subject', 'link' => route('subjects.index')],
    ['name' => 'View Subject']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Subject Form', 'subtitle' => 'View', 'subtitleCode' => 'Record'])
    @if (!auth()->user()->contact->is_student)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#video"><em class="icon ni ni-plus"></em><span>Add Video</span></button>
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#file"><em class="icon ni ni-plus"></em><span>Add File</span></button>
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#announcement"><em class="icon ni ni-plus"></em><span>Add Announcement</span></button>
    <a href="{{ route('subjects.create-exam' , ['subject' => $subject])  }}" class="btn btn-primary mb-2"><em class="icon ni ni-plus"></em><span>Add Exam</span></a>
    @endif
    <a href="{{ route('subjects.show-all-topics' , ['subject' => $subject])  }}" class="btn btn-primary mb-2"><em class="icon ni ni-eye"></em><span>Show All</span></a>
    @include('subject.subject-topic-modal', ['subject' => $subject])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="#" class="row gy-4" method="POST">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" disabled value="{{ $subject->name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="subject_code">Subject Code</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="subject_code" placeholder="Enter code" name="subject_code" disabled value="{{ $subject->subject_code }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="number_of_units">Number of units</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="number_of_units" placeholder="Enter unit" name="number_of_units" disabled value="{{ $subject->number_of_units }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="subject_description">Subject Description</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="subject_description" placeholder="Enter subject description" name="subject_description" disabled value="{{ $subject->subject_description }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="section_id">Class</label>
                            <div class="form-control-wrap">
                                <select name="section_id" id="section_id" class="form-control" disabled>
                                    <option >{{ $subject->section->name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- STUDENTS --}}
    @include('includes.title', ['title' => "Students", 'subtitle' => 'You have ' . count($subject->subjectStudents), 'subtitleCode' => 'students '])
    @if (!auth()->user()->contact->is_student)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalDefault"><em class="icon ni ni-plus"></em><span>Add Student</span></button>
    @endif
    <div class="modal fade" tabindex="-1" id="modalDefault">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subjects.add-student', ['subject' => $subject]) }}" class="row" method="POST">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="contact_id">Student</label>
                                <div class="form-control-wrap">
                                    <select name="contact_id" id="contact_id" class="form-control" required>
                                        @foreach($contacts as $contact)
                                            <option value="{{ $contact->id }}">{{ $contact->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <input type="submit" value="Save" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Student form</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">User</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Activated</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subject->subjectStudents as $subjectStudent)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    @if (!$subjectStudent->contact->profile_picture)
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <span>{{ strtoupper($subjectStudent->contact->two_letters) }}</span>
                                    </div>
                                    @else
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <img src="{{ $subjectStudent->contact->profile_picture }}" alt="{{ $subjectStudent->contact->full_name }}">
                                    </div>
                                    @endif
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            {{ $subjectStudent->contact->full_name }}
                                            @if ($subjectStudent->contact->user->is_activated)
                                                <span class="dot dot-success d-md-none ms-1"></span>
                                            @else
                                                <span class="dot dot-danger d-md-none ms-1"></span>
                                            @endif
                                        </span>
                                        <span>{{ $subjectStudent->contact->user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                {{ $subjectStudent->contact->user->is_activated ? 'Activated' : 'Deactivated' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
