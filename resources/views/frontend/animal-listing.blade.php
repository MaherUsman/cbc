@extends('frontend.layout.index')

@section('content')

    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div
                class="parallax-inner back-img"
                style="background-image: url({{ asset('assets/images/background/page-title.jpg') }});"
            ></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Animals</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- animals-page-section -->
    <section class="animals-page-section">
        <div class="auto-container">
            @isset($category)
            <div class="row clearfix pb-5">
                <h6 class="section-title">{{$category->name}}</h6>
            </div>
            @endisset

            <div class="row clearfix" id="animal-list">
                @foreach($animals as $animal)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{ asset($animal->image) }}" alt="" />
                                </figure>
                                <div class="content-box">
                                    <h3><a href="{{ route('frontend.find.animal', $animal->slug) }}">{{ $animal->title }}</a></h3>
                                </div>
                                <div class="overlay-content">
                                    <h3><a href="{{ route('frontend.find.animal', $animal->slug) }}">{{ $animal->title }}</a></h3>
                                    <div class="link">
                                        <a href="{{ route('frontend.find.animal', $animal->slug) }}"><i class="flaticon-right-arrow"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            @if ($animals->hasMorePages())
                <div class="text-center" id="load-more-container">
                    <button id="load-more" data-page="1" class="theme-btn btn-one">Load More</button>
                </div>
            @endif
        </div>
    </section>
    <!-- animals-page-section end -->



@endsection

@push('scripts')
    <script>
        $(document).on('click', '#load-more', function () {
            let page = $(this).data('page');
            page += 1;

            $.ajax({
                url: '{{ route("frontend.listing.animal") }}',
                type: 'GET',
                data: {page: page},
                success: function (response) {
                    $('#animal-list').append(response.html);

                    // Update the page count
                    $('#load-more').data('page', page);

                    // Check if there are more pages
                    if (!response.morePages) {
                        $('#load-more').hide();  // Hide the button when there are no more pages
                    }
                }
            });
        });
    </script>
@endpush
