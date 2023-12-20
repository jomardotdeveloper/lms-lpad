@extends('layouts.master')
@section('title', 'Create subject')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Subject', 'link' => route('subjects.index')],
    ['name' => 'Create Subject']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Subject Form', 'subtitle' => 'New', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">

            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('subjects.store') }}" class="row gy-4" method="POST">
                    @csrf
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
                            <label class="form-label" for="subject_code">Subject Code</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="subject_code" placeholder="Enter code" name="subject_code" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="number_of_units">Number of units</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="number_of_units" placeholder="Enter unit" name="number_of_units" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="subject_description">Subject Description</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="subject_description" placeholder="Enter subject description" name="subject_description" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="section_id">Class</label>
                            <div class="form-control-wrap">
                                <select name="section_id" id="section_id" class="form-control" required>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
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
