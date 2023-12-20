@extends('layouts.master')
@section('title', 'Create Section')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classes', 'link' => route('sections.index')],
    ['name' => 'Create Class']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Class Form', 'subtitle' => 'New', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('sections.store') }}" class="row gy-4" method="POST">
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
                            <label class="form-label" for="school_year_id">School Year</label>
                            <div class="form-control-wrap">
                                <select name="school_year_id" id="school_year_id" class="form-control" required>
                                    @foreach($schoolYears as $schoolYear)
                                        <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
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
