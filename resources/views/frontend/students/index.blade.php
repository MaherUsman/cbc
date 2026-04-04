@extends('frontend.layout.index')

@section('content')

    <style>
        .student-gallery-section {
            padding: 80px 0;
            background-color: #fcfcfc;
        }

        .student-card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .student-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: #f1f1f1;
        }

        .student-image-wrapper {
            position: relative;
            height: 260px;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        .student-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.6s ease;
        }

        .student-card:hover .student-image-wrapper img {
            transform: scale(1.05);
        }

        .student-content {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .student-name {
            font-family: 'Rubik', sans-serif;
            font-weight: 600;
            font-size: 19px;
            color: #1a1a1a;
            margin-bottom: 0px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .student-info-list {
            margin: 0;
            padding: 0;
            list-style: none;
            margin-top: 0px;
        }

        .info-item {
            /* display: flex; */
            justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 12.5px;
            color: #888;
            font-weight: 500;
            width: 100%;
            padding-right: 10px;
            display: block;
        }

        .info-value {
            font-size: 12.5px;
            color: #444;
            font-weight: 500;
            width: 100%;
            text-align: right;
            word-break: break-word;
        }

        .no-students-msg {
            padding: 60px;
            text-align: center;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            color: #777;
            font-size: 18px;
        }
    </style>

    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img"
                style="background-image: url({{asset('assets/images/background/page-title.jpg')}});">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ \App\Models\Settings::first()->student_page_title ?? 'Our Veterinarian' }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="img-wrap parallax-demo-1 active" style="overflow: hidden;">
        <div class="parallax-inner back-img"></div>
    </div>

    @php
        $studentDescription = \App\Models\Settings::first()->student_page_description ?? '';
    @endphp

    @if (!empty($studentDescription))
        <section class="sec-pad pt-5 pb-0">
            <div class="auto-container">
                {!! $studentDescription !!}
            </div>
        </section>
    @endif

    <section class="student-gallery-section">
        <div class="auto-container">
            <div class="row clearfix" id="student-list">
                @forelse($students as $student)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="student-card">
                            <div class="student-image-wrapper">
                                @if($student->picture)
                                    <img src="{{ asset($student->picture) }}" alt="{{ $student->name }}">
                                @else
                                    <img src="{{ asset('no_image.jpg') }}" alt="No Image">
                                @endif
                            </div>
                            <div class="student-content">
                                <h3 class="student-name" title="{{ $student->name }}">{{ $student->name }}</h3>
                                <ul class="student-info-list">
                                    <li class="info-item">
                                        <span class="info-label">Internship Year</span>
                                        <span class="info-value">{{ $student->internship_year ?? '-' }}</span>
                                    </li>
                                    <li class="info-item">
                                        <span class="info-label">Education</span>
                                        <span class="info-value">{{ $student->education ?? '-' }}</span>
                                    </li>
                                    <li class="info-item">
                                        <span class="info-label">Internship with HFIP</span>
                                        <span class="info-value">{{ $student->service_attachment ?? '-' }}</span>
                                    </li>
                                    <li class="info-item">
                                        <span class="info-label">Service with HFIP</span>
                                        <span class="info-value">{{ $student->internship ?? '-' }}</span>
                                    </li>
                                    <li class="info-item">
                                        <span class="info-label">Externship with IFHC</span>
                                        <span class="info-value">{{ $student->internship_training ?? '-' }}</span>
                                    </li>
                                    <li class="info-item">
                                        <span class="info-label">Present Status</span>
                                        <span class="info-value">{{ $student->present_status ?? '-' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="no-students-msg">
                            <i class="fas fa-user-graduate mb-3" style="font-size: 40px; opacity: 0.3;"></i>
                            <p>No students found at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection