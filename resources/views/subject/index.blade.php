@extends('layouts.master')
@section('title', 'Subject')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Subjects',]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    <div class="alert alert-fill alert-warning alert-dismissible alert-icon">
        <em class="icon ni ni-cross-circle"></em> <strong>Warning</strong>!
        Some features are not yet implemented due to some coding issues.
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
    @include('includes.title', ['title' => 'Subjects', 'subtitle' => 'You have ' . count($subjects), 'subtitleCode' => 'Records '])
    <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-2"><em class="icon ni ni-plus"></em><span>Add Subject</span></a>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Code</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Teacher</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Class</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                {{ $subject->name }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $subject->code }}
                            </td>

                            <td class="nk-tb-col">
                                {{ $subject->contact->full_name }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $subject->section->name }}
                            </td>

                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('subjects.show', ['subject' => $subject]) }}"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                    <li><a href="{{ route('subjects.edit', ['subject' => $subject]) }}"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
                                                    <li><a href="javascript:void(0);" onclick="deleteData({{ $subject->id }})"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
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
            url: "{{ route('subjects.store') }}"+'/'+id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                window.location = "{{ route('subjects.index') }}?success=Successfuly+deleted+record.";
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>
@endpush
