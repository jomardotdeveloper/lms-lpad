@extends('layouts.master')
@section('title', 'Classroom')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classrooms',]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Classrooms', 'subtitle' => 'You have ' . count($classrooms), 'subtitleCode' => 'Records '])
    @if (!auth()->user()->contact->is_student)
    <a href="{{ route('classrooms.create') }}" class="btn btn-primary mb-2"><em class="icon ni ni-plus"></em><span>Add Classroom</span></a>
    @elseif(auth()->user()->contact->is_student)
    <form action="{{ route('classrooms.enroll') }}" method="POST" class="row">
        @csrf
        <div class="col-2">
            <div class="form-group">
                <label for="code">Classroom Code</label>
                <input type="text" class="form-control" id="classroom_code" name="code" placeholder="Enter Code">
            </div>
        </div>

        <div class="col-6">

            <button type="submit" class="btn btn-primary mt-4">Enroll</button>
        </div>

    </form>
    @endif

    <div class="row">
        @forelse ($classrooms as $classroom)
        <div class="col-4">
            <div class="card">
                <img src="{{ $classroom->image_src }}" class="card-img-top" alt="">
                <div class="card-inner">
                    <h5 class="card-title">{{  $classroom->name  }}</h5>
                    <p class="card-text">{{ $classroom->description }} </p>
                    <a href="{{ route('classrooms.show', $classroom) }}" class="btn btn-primary">Open</a>
                </div>
            </div>
        </div>

        @empty

        <p>No Classroom</p>


        @endforelse

    </div>
</div>

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
</script>
@endpush
