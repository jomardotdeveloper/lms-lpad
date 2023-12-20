@extends('layouts.master')
@section('title', 'Section')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classes',]
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Classes', 'subtitle' => 'You have ' . count($sections), 'subtitleCode' => 'Records '])
    @if (!auth()->user()->contact->is_student)
    <a href="{{ route('sections.create') }}" class="btn btn-primary mb-2"><em class="icon ni ni-plus"></em><span>Add Class</span></a>
    @endif

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">School Year</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                {{ $section->name }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $section->schoolYear->name }}
                            </td>

                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('sections.show', ['section' => $section]) }}"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                    @if (!auth()->user()->contact->is_student)
                                                    <li><a href="{{ route('sections.edit', ['section' => $section]) }}"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
                                                    <li><a href="javascript:void(0);" onclick="deleteData({{ $section->id }})"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                    @endif
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
            url: "{{ route('sections.store') }}"+'/'+id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                window.location = "{{ route('sections.index') }}?success=Successfuly+deleted+record.";
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>
@endpush
