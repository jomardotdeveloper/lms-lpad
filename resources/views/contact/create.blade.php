@extends('layouts.master')
@section('title', 'Create ' . $title)

@section('content')
@php
    $param = "";

    if(isset($_GET['is_teacher'])) {
        $param = "?is_teacher=" . $_GET['is_teacher'];
    } else if(isset($_GET['is_student'])) {
        $param = "?is_student=" . $_GET['is_student'];
    } else if(isset($_GET['is_admin'])) {
        $param = "?is_admin=" . $_GET['is_admin'];
    }
@endphp
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => $title, 'link' => route('contacts.index') . $param],
    ['name' => 'Create ' . $title]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $title .  ' Form', 'subtitle' => 'New', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('contacts.store') }}" class="row gy-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($_GET['is_teacher']))
                        <input type="hidden" name="is_teacher" value="{{ $_GET['is_teacher'] }}" />
                    @elseif (isset($_GET['is_student']))
                        <input type="hidden" name="is_student" value="{{ $_GET['is_student'] }}" />
                    @elseif (isset($_GET['is_admin']))
                        <input type="hidden" name="is_admin" value="{{ $_GET['is_admin'] }}" />
                    @endif
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="first_name">First Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="first_name" placeholder="Enter name" name="first_name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="middle_name">Middle Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="middle_name" placeholder="Enter name" name="middle_name" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="last_name">Last Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="last_name" placeholder="Enter name" name="last_name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="address">Address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required/>
                            </div>
                        </div>
                    </div>
                    @if (isset($_GET['is_teacher']))
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="department_id">Department</label>
                            <div class="form-control-wrap">
                                <select name="department_id" id="department_id" class="form-control" required>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    @elseif(isset($_GET['is_student']))
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="section_id">Class</label>
                            <div class="form-control-wrap">
                                <select name="section_id" id="section_id" class="form-control" required>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    @endif

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="profile_picture">Profile Picture</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" id="profile_picture" placeholder="Enter profile_picture" name="profile_picture" />
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
