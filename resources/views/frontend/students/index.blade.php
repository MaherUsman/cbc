@extends('frontend.layout.index')

@section('content')

    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img"
                 style="background-image: url({{asset('assets/images/background/page-title.jpg')}});">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Our Vet Dr</h1>
                </div>
            </div>
        </div>
    </section>

    {{--    <section class="page-title"> <!-- small top space -->--}}
        <div class="img-wrap parallax-demo-1 active"
             style="overflow: hidden;">
            <div class="parallax-inner back-img"></div>
        </div>
{{--    </section>--}}

        <div class="auto-container">


            <div class="row content-box" style="margin-top: 2%" id="student-list">
                @forelse($students as $student)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block" style="display:flex;">
                        <!-- simplified student card to ensure image is on top and table sits below -->
                        <div class="student-card" style="border:1px solid #e6e6e6;padding:12px;background:#fff;height:100%;display:flex;flex-direction:column;width:100%;">
                            <div class="student-image" style="height:240px;overflow:hidden;margin-bottom:12px;display:flex;align-items:center;justify-content:center;background:#f5f5f5;">
                                @if($student->picture)
                                    <img src="{{ asset($student->picture) }}" alt="{{ $student->name }}" style="width:100%;height:100%;object-fit:cover;display:block;"/>
                                @else
                                    <img src="{{ asset('no_image.jpg') }}" alt="No Image" style="width:100%;height:100%;object-fit:cover;display:block;"/>
                                @endif
                            </div>

                            <div class="student-body" style="flex:1;display:flex;flex-direction:column;">
                                <!-- name area constrained to two lines so all cards align consistently -->
                                <h3 class="student-name" style="font-size:18px;margin:0 0 8px 0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:44px;">{{ $student->name }}</h3>

                                <div class="student-meta" style="margin-top:auto;">
                                    <table class="table table-sm table-bordered mb-0" style="width:100%;table-layout:fixed;">
                                        <tbody>
                                        <tr><th style="width:40%;white-space:normal;">Internship Year</th><td style="word-wrap:break-word;">{{ $student->internship_year ?? '-' }}</td></tr>
                                        <tr><th style="white-space:normal;">Education</th><td style="word-wrap:break-word;">{{ $student->education ?? '-' }}</td></tr>
                                        <tr><th style="white-space:normal;">Service / Attachment</th><td style="word-wrap:break-word;">{{ $student->service_attachment ?? '-' }}</td></tr>
                                        <tr><th style="white-space:normal;">Internship / Training with IFHC</th><td style="word-wrap:break-word;">{{ $student->internship_training ?? '-' }}</td></tr>
                                        <tr><th style="white-space:normal;">Present Status</th><td style="word-wrap:break-word;">{{ $student->present_status ?? '-' }}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">No students found.</div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
