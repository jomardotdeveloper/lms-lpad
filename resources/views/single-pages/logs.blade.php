@extends('layouts.master')
@section('title', $title)

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => $title]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $title, 'subtitle' => 'You have ' . count($logs), 'subtitleCode' => 'Records '])
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">User</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                {{ $log->user->contact->full_name }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $log->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
