@extends('layouts.master')
@section('title', 'View Section')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classes', 'link' => route('sections.index')],
    ['name' => 'View Class']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Class Form', 'subtitle' => 'View', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="#" class="row gy-4" method="POST">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $section->name }}" disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="school_year_id">School Year</label>
                            <div class="form-control-wrap">
                                <select name="school_year_id" id="school_year_id" class="form-control" disabled>
                                    <option value="">{{ $section->schoolYear->name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
