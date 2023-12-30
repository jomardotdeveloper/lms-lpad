@extends('layouts.master')
@section('title', 'Edit Topic')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classroom', 'link' => route('classrooms.index')],
    ['name' => $classroom->name, 'link' => route('classrooms.show', $classroom)],
    ['name' => 'Edit Topic']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Topic Form', 'subtitle' => 'Edit', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">

            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('topics.update', $topic) }}" class="row gy-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required value="{{ $topic->name }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" required value="{{ $topic->description }}"/>
                            </div>
                        </div>
                    </div>

                    @if ($type == "video")
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="video_src">Update Video</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" id="video_src" placeholder="Enter video_src" name="video_src"/>
                            </div>
                        </div>
                    </div>
                    @elseif($type == "file")
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="file_src">Update File</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" id="file_src" placeholder="Enter file_src" name="file_src"/>
                            </div>
                        </div>
                    </div>
                    @endif


                    <div class="col-sm-12">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
