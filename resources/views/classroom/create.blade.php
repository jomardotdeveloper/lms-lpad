@extends('layouts.master')
@section('title', 'Create Classroom')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classroom', 'link' => route('classrooms.index')],
    ['name' => 'Create Classroom']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Classroom Form', 'subtitle' => 'New', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">

            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('classrooms.store') }}" class="row gy-4" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="image_src">Image</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" id="image_src" placeholder="Enter image_src" name="image_src" required/>
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
