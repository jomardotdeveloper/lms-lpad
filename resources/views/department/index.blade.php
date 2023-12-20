@extends('layouts.master')
@section('title', 'Department')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Departments',]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Departments', 'subtitle' => 'You have ' . count($departments), 'subtitleCode' => 'Records '])
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-2"><em class="icon ni ni-plus"></em><span>Add Department</span></a>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Person In Charge</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                {{ $department->name }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $department->person_in_charge }}
                            </td>

                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('departments.show', ['department' => $department]) }}"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                    <li><a href="{{ route('departments.edit', ['department' => $department]) }}"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
                                                    <li><a href="javascript:void(0);" onclick="deleteData({{ $department->id }})"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
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
            url: "{{ route('departments.store') }}"+'/'+id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                window.location = "{{ route('departments.index') }}?success=Successfuly+deleted+record.";
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>
@endpush
