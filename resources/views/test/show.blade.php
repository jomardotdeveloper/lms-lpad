@extends('layouts.master')
@section('title', 'Create Exam')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classroom', 'link' => route('classrooms.index')],
    ['name' => $classroom->name, 'link' => route('classrooms.show', $classroom)],
    ['name' => 'Take Exam']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Take Exam', 'subtitle' => 'New', 'subtitleCode' => 'Submission'])
    <form action="{{ route('tests.submit') }}" method="POST">
        @csrf
        <div class="row">
            {{-- MULTPLE CHOICE --}}
            @if (count($multiple_choices)> 0)
            <h6>Multiple Choice</h6>
            @endif

            @php
                $no = 1;
            @endphp
            @foreach ($multiple_choices as $item)
            <div class="col-6">
                <div class="card">
                    <div class="card-inner">
                        <h5 class="card-title">#{{$no }}</h5>
                        <h6 class="card-subtitle mb-2">{{ $item->name }}</h6>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{ $item->id }}choiceA" name="{{ $item->id }}" class="custom-control-input" required
                                value="{{ $item->choice_a }}">
                            <label class="custom-control-label" for="{{ $item->id }}choiceA">{{ $item->choice_a }}</label>
                        </div> </br></br>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{ $item->id }}choiceB" name="{{ $item->id }}" class="custom-control-input" required value="{{ $item->choice_b }}">
                            <label class="custom-control-label" for="{{ $item->id }}choiceB">{{ $item->choice_b }}</label>
                        </div> </br></br>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{ $item->id }}choiceC" name="{{ $item->id }}" class="custom-control-input" required value="{{ $item->choice_c }}">
                            <label class="custom-control-label" for="{{ $item->id }}choiceC">{{ $item->choice_c }}</label>
                        </div> </br></br>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{ $item->id }}choiceD" name="{{ $item->id }}" class="custom-control-input" required value="{{ $item->choice_d }}">
                            <label class="custom-control-label" for="{{ $item->id }}choiceD">{{ $item->choice_d }}</label>
                        </div> </br></br>
                    </div>
                </div>
            </div>
            @php
                $no++;
            @endphp
            @endforeach






        </div>

            {{-- TRUE OR FALSE --}}
        <div class="row mt-2">
            @if (count($true_or_falses) > 0)

            <h6>True or False</h6>
            @endif
            @foreach ($true_or_falses as $item)
            <div class="col-6">
                <div class="card">
                    <div class="card-inner">
                        <h5 class="card-title">#{{$no }}</h5>
                        <h6 class="card-subtitle mb-2">{{ $item->name }}</h6>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{ $item->id }}true" name="{{ $item->id }}" class="custom-control-input" required value="True">
                            <label class="custom-control-label" for="{{ $item->id }}true">True</label>
                        </div> </br></br>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{ $item->id }}false" name="{{ $item->id }}" class="custom-control-input" required value="False">
                            <label class="custom-control-label" for="{{ $item->id }}false">False</label>
                        </div> </br></br>

                    </div>
                </div>
            </div>
            @php
                $no++;
            @endphp

        @endforeach
        </div>


            {{-- IDENTIFICATION --}}

        <div class="row mt-2">
            <h6>Identification</h6>
            @foreach ($identifications as $item)
            <div class="col-6">
                <div class="card">
                    <div class="card-inner">
                        <h5 class="card-title">#{{ $no }}</h5>
                        <h6 class="card-subtitle mb-2">{{ $item->name }}</h6>
                        <input type="text" class="form-control" name="{{ $item->id }}" required>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <input type="hidden" name="test_id" value="{{ $test->id }}">

        <div class="row mt-2">
            <div class="col-12">
                <input type="submit" value="Submit" class="btn btn-primary" />
            </div>
        </div>


    </form>

</div>


@endsection
