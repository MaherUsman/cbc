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
                    <h1>Hydration</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <section class="pt-5">
        <div class="auto-container">
            <div class="">
                <h1 class="pb-3">{{$topasGalleryContent->data['title'] ?? ''}}</h1>
                {!! $topasGalleryContent->data['details'] ?? '' !!}
            </div>

        </div>
    </section>



    <!-- gallery-page-section -->
    <section class="gallery-page-section">
        <div class="auto-container">
            <div class="row clearfix" id="gallery-items">
                @include('frontend.gallery.partials.tobas-gallery-items', ['topasGallery' => $topasGallery])
            </div>
            <div class="text-center">
                @if ($topasGallery->hasMorePages())
                    <button id="load-more" data-page="1" class="theme-btn btn-one">Load More</button>
                @endif
            </div>
        </div>
    </section>
    <!-- gallery-page-section end -->

    <!-- bottom-image-section -->
    <section class="bottom-image-section pb-5" style="margin-top: 30px;">
        <div class="auto-container">
            <div class="image-box text-center">
                <img src="{{ asset('assets/images/background/page-title.jpg') }}" alt="Hydration" class="img-fluid" style="width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); object-fit: cover; max-height: 500px;">
            </div>
        </div>
    </section>
    <!-- bottom-image-section end -->
@endsection

@push('scripts')
    <script>
        $(document).on('click', '#load-more', function () {
            let page = $(this).data('page');
            page += 1;

            $.ajax({
                url: '{{ route("frontend.topas.gallery") }}',
                type: 'GET',
                data: { page: page },
                success: function (response) {
                    $('#gallery-items').append(response.html);
                    $('#load-more').data('page', page);
                    Fancybox.bind("[data-fancybox='gallery']", {});


                    if (!response.morePages) {
                        $('#load-more').hide();  // Hide the button when there are no more pages
                    }
                }
            });
        });
    </script>

@endpush