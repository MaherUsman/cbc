@extends('frontend.layout.index')

@section('content')
    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img"
                 style="background-image: url({{asset('assets/images/background/page-title.jpg')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ $parentGallery->title??'' }} Gallery</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- gallery-page-section -->
    <section class="gallery-page-section">
        <div class="auto-container">
            <div class="row clearfix" id="gallery-items">
                @include('frontend.gallery.partials.aboutuse-gallery-items', ['aboutUsGalleries' => $aboutUsGalleries])
            </div>
            <div class="text-center">
                @if ($aboutUsGalleries->hasMorePages())
                    <button id="load-more" data-page="1" class="btn btn-primary">Load More</button>
                @endif
            </div>
        </div>
    </section>
    <!-- gallery-page-section end -->
@endsection

@push('scripts')
    <script>
        $(document).on('click', '#load-more', function () {
            let page = $(this).data('page');
            page += 1;

            $.ajax({
                url: '{{ route("frontend.aboutus.gallery" , $id) }}',
                type: 'GET',
                data: {page: page},
                success: function (response) {
                    $('#gallery-items').append(response.html);

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
