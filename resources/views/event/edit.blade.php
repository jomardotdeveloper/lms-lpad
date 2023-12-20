@extends('layouts.master')
@section('title', 'Edit Event')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Event', 'link' => route('events.index')],
    ['name' => 'Edit Event']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Event Form', 'subtitle' => 'Edit', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('events.update', ['event' => $event]) }}" class="row gy-4" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required value="{{ $event->name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="start">From</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" id="start" placeholder="Enter start" name="start" required value="{{ $event->start }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="end">End</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" id="end" placeholder="Enter end" name="end" required value="{{ $event->end }}"/>
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
