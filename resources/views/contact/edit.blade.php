@extends('layouts.master')
@section('title', 'Edit ' . $title)

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
    ['name' => 'Edit ' . $title]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $title .  ' Form', 'subtitle' => 'Edit', 'subtitleCode' => 'Record'])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('contacts.update', ['contact' => $contact]) }}" class="row gy-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="first_name">First Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="first_name" placeholder="Enter name" name="first_name" required value="{{ $contact->first_name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="middle_name">Middle Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="middle_name" placeholder="Enter name" name="middle_name" value="{{ $contact->middle_name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="last_name">Last Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="last_name" placeholder="Enter name" name="last_name" required value="{{ $contact->last_name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="address">Address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required value="{{ $contact->address }}"/>
                            </div>
                        </div>
                    </div>
                    @if (isset($_GET['is_teacher']))
                    <div class="col-sm-6">
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
                    </div>
                    @elseif(isset($_GET['is_student']))
                    <div class="col-sm-6">
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
                    </div>
                    @endif

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required value="{{ $contact->user->email }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="profile_picture">Update Profile Picture</label>
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
