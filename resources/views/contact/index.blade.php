@extends('layouts.master')
@section('title', $title)

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
    ['name' => $title,]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => $title, 'subtitle' => 'You have ' . count($contacts), 'subtitleCode' => 'Records '])
    <a href="{{ route('contacts.create') }}{{ $param }}" class="btn btn-primary mb-2"><em class="icon ni ni-plus"></em><span>Add Record</span></a>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">User</span></th>
                        @if (isset($_GET['is_teacher']))
                        {{-- <th class="nk-tb-col tb-col-md"><span class="sub-text">Department</span></th> --}}
                        @elseif (isset($_GET['is_student']))
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Class</span></th>
                        @endif

                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Activated</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    @if (!$contact->profile_picture)
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <span>{{ strtoupper($contact->two_letters) }}</span>
                                    </div>
                                    @else
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <img src="{{ $contact->profile_picture }}" alt="{{ $contact->full_name }}">
                                    </div>
                                    @endif
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            {{ $contact->full_name }}
                                            @if ($contact->user->is_activated)
                                                <span class="dot dot-success d-md-none ms-1"></span>
                                            @else
                                                <span class="dot dot-danger d-md-none ms-1"></span>
                                            @endif
                                        </span>
                                        <span>{{ $contact->user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            @if (isset($_GET['is_teacher']))
                                {{-- <td class="nk-tb-col tb-col-mb" data-order="35040.34">
                                    {{ $contact->department->name }}
                                </td> --}}
                            @elseif (isset($_GET['is_student']))
                                <td class="nk-tb-col tb-col-mb" data-order="35040.34">
                                    {{ $contact->section->name }}
                                </td>



                            @endif

                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                {{ $contact->user->is_activated ? 'Activated' : 'Deactivated' }}
                            </td>

                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    @if ($contact->user->is_activated)
                                                        <li><a href="{{ route('contacts.deactivate', ['contact' => $contact]) }}"><em class="icon ni ni-user-cross-fill"></em><span>Deactivate</span></a></li>
                                                    @else
                                                        <li><a href="{{ route('contacts.activate', ['contact' => $contact]) }}"><em class="icon ni ni-user-check-fill"></em><span>Activate</span></a></li>
                                                    @endif
                                                    <li><a href="{{ route('contacts.show', ['contact' => $contact]) }}{{ $param }}"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                    <li><a href="{{ route('contacts.edit', ['contact' => $contact]) }}{{ $param }}"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
                                                    <li><a href="javascript:void(0);" onclick="deleteData({{ $contact->id }})"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    function deleteData(id) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('contacts.store') }}"+'/'+id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                window.location = "{{ route('contacts.index') }}?success=Successfuly+deleted+record.";
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>
@endpush
