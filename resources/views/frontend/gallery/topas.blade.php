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
                    <h1>Tobas</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <section class="pt-5">
        <div class="auto-container">
            <div class="row clearfix">
                <h1 class="pb-3">Tobas</h1>
                <p>
                lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
           
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
@endsection

@push('scripts')
    <script>
        $(document).on('click', '#load-more', function () {
            let page = $(this).data('page');
            page += 1;

            $.ajax({
                url: '{{ route("frontend.topas.gallery") }}',
                type: 'GET',
                data: {page: page},
                success: function (data) {
                    $('#gallery-items').append(data);
                    $('#load-more').data('page', page);

                    // If no more pages, hide the Load More button
                    if (data.trim() === '') {
                        $('#load-more').hide();
                    }
                }
            });
        });
    </script>
   
@endpush
