@extends('layouts.master')
@section('title', 'View Question')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Subject', 'link' => route('subjects.index')],
    ['name' => 'View Subject' , 'link' => route('subjects.show', ['subject' => $subject])],
    ['name' => 'View Exam' , 'link' => route('subjects.show-exam' , ['subject' => $subject , 'exam' => $exam])],
    ['name' => 'View Question']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $exam->subjectTopic->name , 'subtitle' => 'View ', 'subtitleCode' => ' question'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('subjects.save-question', ['subject' => $subject, 'question' => $question, 'exam' => $exam]) }}" class="row gy-4" method="POST">
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="question">Question</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="question" placeholder="Enter question" name="question" required value="{{ $question->question }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Answer</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="answer" placeholder="Enter answer" name="answer" required value="{{ $question->answer }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="type">Type</label>
                            <div class="form-control-wrap">
                                <select class="form-control" name="type" id="type">
                                    <option value="multiple_choice">Multiple Choice</option>
                                    <option value="true_false">True/False</option>
                                    <option value="identification">Identification</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Choice</th>
                                <th scope="col">Is Correct</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="choice[]" placeholder="Enter choice" required>
                                </td>
                                <td>
                                    <select name="is_correct[]" id="is_correct" class="form-control">
                                        <option value="0">False</option>
                                        <option value="1">True</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="specialTr">
                                <td colspan="2">
                                    <a href="javascript:void(0);" onclick="addAButton()">Add a line</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="col-sm-12">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        function addAButton() {

            var html = '<tr><td><input type="text" class="form-control" name="choice[]" placeholder="Enter choice" required></td><td><select name="is_correct[]" id="is_correct" class="form-control"><option value="0">False</option><option value="1">True</option></select></td></tr>';

            $('#specialTr').before(html);
        }
    </script>
@endpush
