@extends('layouts.master')
@section('title', 'Create Event')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Event', 'link' => route('events.index')],
    ['name' => 'Create Event']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Event Form', 'subtitle' => 'New', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('events.store') }}" class="row gy-4" method="POST">
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
                            <label class="form-label" for="start">From</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" id="start" placeholder="Enter start" name="start" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="end">End</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" id="end" placeholder="Enter end" name="end" required/>
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
