@extends('layouts.admin.index')
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => 'Students', 'route' => 'students.index'], ['name' => $student->name, 'route' => null]],
        'pageTitle' => $student->name
    ])

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($student->picture)
                        <img src="{{ asset($student->picture) }}" alt="" style="max-width:220px;" class="mb-3" />
                    @endif

                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> {{ $student->name }}</li>
                        <li class="list-group-item"><strong>Internship Year:</strong> {{ $student->internship_year }}</li>
                        <li class="list-group-item"><strong>Education:</strong> {!! nl2br(e($student->education)) !!}</li>
                        <li class="list-group-item"><strong>Service / Attachment with HFIP:</strong> {!! nl2br(e($student->service_attachment_with_hfip)) !!}</li>
                        <li class="list-group-item"><strong>Internship / Training with IFHC, UAE:</strong> {!! nl2br(e($student->internship_training_with_ifhc_uae)) !!}</li>
                        <li class="list-group-item"><strong>Present Status:</strong> {{ $student->present_status }}</li>
                    </ul>

                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning mt-3">Edit</a>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

