@extends('layouts.master')
@section('title', 'View School Years')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'School Years', 'link' => route('school-years.index')],
    ['name' => 'View School Year']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'School Year Form', 'subtitle' => 'View', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="#" class="row gy-4" method="POST">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" disabled value="{{ $schoolYear->name }}"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
