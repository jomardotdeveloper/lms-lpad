@extends('layouts.master')
@section('title', 'View Classroom')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classroom', 'link' => route('classrooms.index')],
    ['name' => 'View Classroom']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $classroom->name, 'subtitle' => 'Description : ', 'subtitleCode' => $classroom->description])

    @if (!auth()->user()->contact->is_student)
    <h6>Code : {{ $classroom->code  }}</h6>
    @endif
    <button class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#showStudents"><em class="icon ni ni-eye"></em><span>Students</span></button>
    @if (!auth()->user()->contact->is_student)
    <button class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#computeGradesModal">Compute Grades</button>
    @include('classroom.grades-modal', ['classroom' => $classroom])
    <a href="{{ route('classrooms.edit', $classroom) }}" class="btn btn-warning mb-2"><em class="icon ni ni-plus"></em><span>Edit</span></a>
    <a href="javascript:void(0);" class="btn btn-primary mb-2" onclick="deleteData({{ $classroom->id }})"><em class="icon ni ni-trash"></em><span>Delete</span></a>

    <a href="{{ route('topics.create') }}?classroom_id={{ $classroom->id }}&&type=file" class="btn btn-success mb-2"><em class="icon ni ni-plus"></em><span>File</span></a>
    <a href="{{ route('topics.create') }}?classroom_id={{ $classroom->id }}&&type=announcement" class="btn btn-success mb-2"><em class="icon ni ni-plus"></em><span>Announcement</span></a>
    <a href="{{ route('topics.create') }}?classroom_id={{ $classroom->id }}&&type=video" class="btn btn-success mb-2"><em class="icon ni ni-plus"></em><span>Video</span></a>
    <a href="{{ route('tests.create') }}?classroom_id={{ $classroom->id }}&&type=test" class="btn btn-success mb-2"><em class="icon ni ni-plus"></em><span>Test</span></a>

    @endif

    <div class="row">
        @forelse ($classroom->topics as $topic)
        @php
            $testIsTaken = false;

            if($topic->type == "test"){
                foreach ($topic->test->testSubmissions as $submission) {
                    if($submission->student_id == auth()->user()->contact->id){
                        $testIsTaken = true;
                    }
                }
            }
        @endphp
        <div class="col-6 mt-2">
            <div class="card">
                <div class="card-inner">
                    <h5 class="card-title">{{ $topic->name }}</h5>
                    <h6 class="card-subtitle mb-2">{{ $topic->created_at }}</h6>
                    <p class="card-text">{{ $topic->description  }}</p>

                    @if ($topic->type == "video")
                    <video class="embed-responsive-item" controls autoplay loop muted style="width:400px;height:250px">
                        <source src="{{ $topic->video_src }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @elseif ($topic->type == "file")
                    <a href="{{ $topic->file_src }}" class="btn btn-primary mb-2"><em class="icon ni ni-eye"></em><span>View File</span></a>
                    @elseif ($topic->type == "test")
                        @if (auth()->user()->contact->is_student)
                        @if ($testIsTaken)
                        @php
                            $testScore = 0;

                            foreach ($topic->test->testSubmissions as $submission) {
                                if($submission->student_id == auth()->user()->contact->id){
                                    // $testScore = $submission->score;
                                    if($submission->is_correct){
                                        $testScore++;
                                    }
                                }
                            }
                        @endphp

                        <h4>Your score is {{ $testScore }} </h4>
                        @else
                        <a href="{{ route('tests.show', $topic->test) }}?classroom_id={{ $classroom->id }}&&type={{ $topic->type }}" class="btn btn-info mb-2"><em class="icon ni ni-pen"></em><span>Take Exam</span></a>
                        @endif

                        @endif
                    @endif

                    @if (!auth()->user()->contact->is_student)
                        @if ($topic->type == "test")
                        <a href="{{ route('tests.edit', $topic->test) }}?classroom_id={{ $classroom->id }}&&type={{ $topic->type }}" class="btn btn-warning mb-2"><em class="icon ni ni-eye"></em><span>Show Submissions</span></a>
                        <a href="javascript:void(0);" class="btn btn-primary mb-2" onclick="deleteTest({{ $topic->test->id }})"><em class="icon ni ni-trash"></em><span>Delete</span></a>
                        @else
                        <a href="{{ route('topics.edit', $topic) }}?classroom_id={{ $classroom->id }}&&type={{ $topic->type }}" class="btn btn-warning mb-2"><em class="icon ni ni-pen"></em><span>Edit</span></a>
                        <a href="javascript:void(0);" class="btn btn-primary mb-2" onclick="deleteTopic({{ $topic->id }})"><em class="icon ni ni-trash"></em><span>Delete</span></a>
                        @endif

                    @endif


                </div>
            </div>
        </div>

        @empty
        <p>No Topic.</p>
        @endforelse

    </div>
</div>
@include('classroom.students-modal', ['classroom' => $classroom]);


@endsection
@push('scripts')
<script>
    function deleteData(id) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('classrooms.store') }}"+'/'+id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                window.location = "{{ route('classrooms.index') }}?success=Successfuly+deleted+record.";
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function deleteTopic(id) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('topics.store') }}"+'/'+id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                window.location = "{{ route('classrooms.show', $classroom) }}?success=Successfuly+deleted+record.";
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function deleteTest(id) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('tests.store') }}"+'/'+id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                window.location = "{{ route('classrooms.show', $classroom) }}?success=Successfuly+deleted+record.";
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>

@endpush
