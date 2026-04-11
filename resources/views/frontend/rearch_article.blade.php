@extends('frontend.layout.index')

@section('content')

    <style>
        .publications-container {
            padding: 40px 0;
            font-family: 'Roboto', sans-serif;
        }

        .publication-card {
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .publication-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }

        .publication-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .publication-title a {
            color: #2c3e50;
            text-decoration: none;
        }

        .publication-title a:hover {
            color: #F29021;
        }

        .publication-meta {
            font-size: 0.85rem;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .publication-meta .date {
            margin-right: 15px;
        }

        .publication-excerpt {
            color: #34495e;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .card-footer {
            border-top: 1px solid #f1f1f1;
            padding: 15px;
            margin-top: auto;
            background: transparent;
        }

        .btn-pdf-download {
            background-color: #F29021;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 15px;
            font-size: 0.9rem;
            /*width: 100%;*/
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn-pdf-download:hover {
            background-color: #F29021;
            color: white;
        }

        .btn-read-more {
            color: #3498db;
            border: 1px solid #3498db;
            border-radius: 4px;
            padding: 8px 15px;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .btn-read-more:hover {
            background-color: #3498db;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-footer {
                flex-direction: column;
                gap: 10px;
            }

            .btn-pdf-download, .btn-read-more {
                width: 100%;
                text-align: center;
            }
        }

        .publications-container {
            padding: 40px 0;
            font-family: 'Roboto', sans-serif;
        }

        .publication-card {
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .publication-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .publication-date {
            font-size: 0.85rem;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .publication-excerpt {
            color: #34495e;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .card-footer {
            border-top: 1px solid #f1f1f1;
            padding: 15px;
            margin-top: auto;
            background: transparent;
        }

        .btn-pdf-download {
            background-color: #F29021;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 15px;
            font-size: 0.9rem;
            /*width: 100%;*/
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn-pdf-download:hover {
            background-color: #F29021;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

    <!-- Page Title -->
    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img"
                 style="background-image: url({{asset('assets/images/background/page-title.jpg')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <ul class="bread-crumb clearfix">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Research & Articles</li>
                </ul>
                <div class="title">
                    <h1>Research & Articles</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <div class="publications-container">
        <div class="container">
            <div class="row">
                @foreach($researchArticles as $researchArticle)
                    @if($researchArticle->article_pdf_file ==  null || $researchArticle->article_pdf_file == '')
                        @continue
                    @endif
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="publication-card h-100">
                            <div class="card-body">
                                <h3 class="publication-title">
                                    <a href="{{ asset($researchArticle->article_pdf_file) }}"
                                       onclick="window.open('{{ asset($researchArticle->article_pdf_file) }}', '_blank'); return false;">
                                        {{ $researchArticle->title }}
                                    </a>
                                </h3>
                                {{--<div class="publication-meta">
                                    @if($researchArticle->published_date)
                                        <span class="date">{{ $researchArticle->published_date->format('F Y') }}</span>
                                    @endif
                                    @if($researchArticle->author)
                                        <span class="author">By {{ $researchArticle->author }}</span>
                                    @endif
                                </div>--}}
                                @if($researchArticle->abstract)
                                    <p class="publication-excerpt">{{ Str::limit($researchArticle->abstract, 150) }}</p>
                                @endif
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="{{ asset($researchArticle->article_pdf_file) }}"
                                   class="btn btn-pdf-download"
                                   target="_blank"
                                   download="{{ basename($researchArticle->article_pdf_file) }}">
                                    <i class="fas fa-file-pdf me-2"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

{{--    <div class="set-direction-wrapper">--}}
{{--        <div class="auto-container">--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table research-articles-table">--}}
{{--                    <tbody>--}}
{{--                    @foreach($researchArticles as $researchArticle)--}}
{{--                        @dd($researchArticle)--}}
{{--                        <tr>--}}
{{--                            <td class="article-title-cell">--}}
{{--                                <a href="{{ asset($researchArticle->article_pdf_file) }}"--}}
{{--                                   target="_blank"--}}
{{--                                   onclick="window.open('{{ asset($researchArticle->article_pdf_file) }}', '_blank'); return false;"--}}
{{--                                   class="article-title-link">--}}
{{--                                    {{ $researchArticle->title }}--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="text-end">--}}
{{--                                <a href="{{ asset($researchArticle->article_pdf_file) }}"--}}
{{--                                   class="btn btn-sm btn-outline-primary"--}}
{{--                                   target="_blank"--}}
{{--                                   download>--}}
{{--                                    <i class="fas fa-download me-1"></i> Download--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{--<div class="set-direction-wrapper">
        <div class="auto-container">
            <div class="row clearfix pt-2" id="animal-list">
                @foreach($researchArticles as $key => $researchArticle)
                    --}}{{--            <section class="about-section sec-pad ainmal-sec setformobilechin">--}}{{--

                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{ asset($researchArticle->banner_image) }}" alt=""/>
                                </figure>
                                <div class="content-box">
                                    <h3><a
                                            href="{{ route('frontend.researchArticle.FShow', $researchArticle) }}">{{ $researchArticle->title }}</a>
                                    </h3>
                                </div>
                                <div class="overlay-content">
                                    <h3><a
                                            href="{{ route('frontend.researchArticle.FShow', $researchArticle) }}">{{ $researchArticle->title }}</a>
                                    </h3>
                                    <div class="link">
                                        <a href="{{ route('frontend.researchArticle.FShow', $researchArticle) }}"><i
                                                class="flaticon-right-arrow"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    --}}{{--            </section>--}}{{--
                @endforeach
            </div>
        </div>
    </div>--}}
@endsection
