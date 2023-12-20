@extends('layouts.master')
@section('title', 'Edit Department')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Department', 'link' => route('departments.index')],
    ['name' => 'Edit Department']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Department Form', 'subtitle' => 'Edit', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('departments.update', ['department' => $department]) }}" class="row gy-4" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required value="{{ $department->name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="person_in_charge">Person In Charge</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="person_in_charge" placeholder="Enter person" name="person_in_charge" required value="{{ $department->person_in_charge }}"/>
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
