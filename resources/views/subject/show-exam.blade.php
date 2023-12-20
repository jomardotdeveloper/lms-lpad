@extends('layouts.master')
@section('title', 'View Exam')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Subject', 'link' => route('subjects.index')],
    ['name' => 'View Subject' , 'link' => route('subjects.show', ['subject' => $subject])],
    ['name' => 'View Exam']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $subject->name , 'subtitle' => 'View ', 'subtitleCode' => ' exam'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('subjects.add-exam', $subject) }}" class="row gy-4" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="exam">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" disabled value="{{ $exam->subjectTopic->name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Percentage</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="percentage" placeholder="Enter percentage" name="percentage" disabled value="{{ $exam->percentage }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Number of questions</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="number_of_question" placeholder="Enter number of question" name="number_of_question" disabled value="{{ count($exam->questions)  }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10" disabled>{{ $exam->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Question</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Answer</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exam->questions as $question)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                {{ $question->question }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $question->answer }}
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    @if ($question->question == "N/A")
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('subjects.edit-question', ['question' => $question, 'exam' => $exam, 'subject' => $subject]) }}"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    @endif

                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
