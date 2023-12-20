@extends('layouts.master')
@section('title', 'Event')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Events',]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Event', 'subtitle' => 'You have ' . count($events), 'subtitleCode' => 'Records '])
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-2"><em class="icon ni ni-plus"></em><span>Add Event</span></a>
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card">
                    <div class="card-inner">
                        <div id="calendar" class="nk-calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    var events = [
        @foreach ($events as $event)
        {
            id: '{{ $event->id }}',
            title: '{{ $event->name }}',
            start: '{{ $event->start }}',
            end: '{{ $event->end }}',
            className: 'fc-event-success',
            description: '{{ $event->name }}'
        },
        @endforeach
    ];

    console.log(events);
</script>
<script src="{{ asset('assets/js/libs/fullcalendar.js?ver=3.2.2') }}"></script>
<script src="{{ asset('assets/js/apps/calendar.js?ver=3.2.2') }}"></script>
@endpush
