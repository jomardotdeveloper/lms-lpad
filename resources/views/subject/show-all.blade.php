@extends('layouts.master')
@section('title', 'All Topics')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Subject', 'link' => route('subjects.index')],
    ['name' => 'View Subject' , 'link' => route('subjects.show', ['subject' => $subject])],
    ['name' => 'All topics']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $subject->name , 'subtitle' => 'All ', 'subtitleCode' => ' topics'])
    @foreach ($topics as $topic)
    <div class="card mt-2">
        <div class="card-inner">
            <h5 class="card-title">{{ $topic->name  }}</h5>
            <h6 class="card-subtitle mb-2">{{ $topic->created_at }}</h6>
            <p class="card-text">{{ $topic->description  }}</p>
            @if ($topic->type == "video")
            <video class="embed-responsive-item" controls autoplay loop muted style="width:400px;height:250px">
                <source src="{{ $topic->video_src }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            @elseif ($topic->type == "file")
            <a href="{{ $topic->file_src }}" class="btn btn-primary mb-2"><em class="icon ni ni-eye"></em><span>View File</span></a>
            @elseif($topic->type == "exam")
            @if (!auth()->user()->contact->is_student)
            <a href="{{ route('subjects.show-exam' , ['subject' => $subject , 'exam' => $topic])  }}" class="btn btn-primary mb-2"><em class="icon ni ni-eye"></em><span>View Exam</span></a>
            @else
            <a href="/take-exam" class="btn btn-primary mb-2"><em class="icon ni ni-pencil"></em><span>Take Exam</span></a>
            @endif
            @endif

        </div>
    </div>
    @endforeach
</div>
@endsection
