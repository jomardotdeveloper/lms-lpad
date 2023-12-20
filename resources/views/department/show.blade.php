@extends('layouts.master')
@section('title', 'View Department')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Department', 'link' => route('departments.index')],
    ['name' => 'View Department']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Department Form', 'subtitle' => 'View', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="#" class="row gy-4" method="POST">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" disabled value="{{ $department->name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="person_in_charge">Person In Charge</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="person_in_charge" placeholder="Enter person" name="person_in_charge" disabled value="{{ $department->person_in_charge }}"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
