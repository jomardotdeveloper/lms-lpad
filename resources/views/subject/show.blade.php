@extends('layouts.master')
@section('title', 'View subject')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Subject', 'link' => route('subjects.index')],
    ['name' => 'View Subject']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Subject Form', 'subtitle' => 'View', 'subtitleCode' => 'Record'])


</div>
@endsection
