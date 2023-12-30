@extends('layouts.master')
@section('title', 'Edit Exam')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classroom', 'link' => route('classrooms.index')],
    ['name' => $classroom->name, 'link' => route('classrooms.show', $classroom)],
    ['name' => 'All Submissions']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'All Submissions', 'subtitle' => 'All', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">

            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Student</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Question</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Answer</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Student's Answer</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testSubmissions as $testSubmission)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                {{ $testSubmission->student->full_name }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $testSubmission->item->name }}
                            </td>

                            <td class="nk-tb-col">
                                {{ $testSubmission->item->answer }}
                            </td>

                            <td class="nk-tb-col">
                                {{ $testSubmission->answer }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
