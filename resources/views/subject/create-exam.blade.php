@extends('layouts.master')
@section('title', 'New Exam')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Subject', 'link' => route('subjects.index')],
    ['name' => 'View Subject' , 'link' => route('subjects.show', ['subject' => $subject])],
    ['name' => 'New Exam']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $subject->name , 'subtitle' => 'New  ', 'subtitleCode' => ' exam'])
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
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Percentage</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="percentage" placeholder="Enter percentage" name="percentage" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Number of questions</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="number_of_question" placeholder="Enter number of question" name="number_of_question" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
