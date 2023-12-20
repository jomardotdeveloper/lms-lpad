@extends('layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="col-xxl-12 col-md-12">
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-title-group mb-2">
                <div class="card-title">
                    <h6 class="title">Statistics</h6>
                </div>
            </div>
            <ul class="nk-store-statistics">
                <li class="item">
                    <div class="info">
                        <div class="title">Students</div>
                        <div class="count">{{ count($students) }}</div>
                    </div>
                    <em class="icon bg-primary-dim ni ni-user"></em>
                </li>
                <li class="item">
                    <div class="info">
                        <div class="title">Teachers</div>
                        <div class="count">{{ count($teachers) }}</div>
                    </div>
                    <em class="icon bg-info-dim ni ni-users"></em>
                </li>
                <li class="item">
                    <div class="info">
                        <div class="title">Classes</div>
                        <div class="count">{{ count($sections) }}</div>
                    </div>
                    <em class="icon bg-pink-dim ni ni-box"></em>
                </li>
                <li class="item">
                    <div class="info">
                        <div class="title">Subjects</div>
                        <div class="count">{{ count($subjects) }}</div>
                    </div>
                    <em class="icon bg-purple-dim ni ni-server"></em>
                </li>
            </ul>
        </div><!-- .card-inner -->
    </div><!-- .card -->
</div><!-- .col -->
@endsection
