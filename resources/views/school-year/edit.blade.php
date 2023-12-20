@extends('layouts.master')
@section('title', 'Edit School Years')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'School Years', 'link' => route('school-years.index')],
    ['name' => 'Edit School Year']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'School Year Form', 'subtitle' => 'Edit', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('school-years.update', ['school_year' => $schoolYear]) }}" class="row gy-4" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required value="{{ $schoolYear->name }}"/>
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
