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
                    <h1>Activities</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->
    <section class="pt-5">
        <div class="auto-container">
            <div class="">
                <h1 class="pb-3">{{$activityGalleryContent->data['title']??''}}</h1>
                {!! $activityGalleryContent->data['details']??'' !!}
            </div>

        </div>
    </section>
    <!-- gallery-page-section -->
    <section class="gallery-page-section">
        <div class="auto-container">
            <div class="row clearfix" id="gallery-items">
                @include('frontend.gallery.partials.activites-gallery-items', ['activitesGallery' => $activitesGallery])
            </div>
            <div class="text-center">
                @if ($activitesGallery->hasMorePages())
                    <button id="load-more" data-page="1" class="theme-btn btn-one">Load More</button>
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
                url: '{{ route("frontend.activities.gallery") }}',
                type: 'GET',
                data: {page: page},
                success: function (response) {
                    $('#gallery-items').append(response.html);
                    $('#load-more').data('page', page);

                    Fancybox.bind("[data-fancybox='gallery']", {});


                    if (!response.morePages) {
                        $('#load-more').hide();
                    }
                }
            });
        });
    </script>
@endpush
