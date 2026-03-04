<style>
    .gallery-block-two {
        height: 100%;
    }

    .inner-box {
        height: 100%;
    }

    .image-box {
        height: 270px;
    }

    .gallery-block-two .inner-box .image-box img {
        height: 100%;
        object-fit: cover;
    }
</style>

@foreach ($visitorGallery as $gallery)
    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
        <div class="gallery-block-two">
            <div class="inner-box">
                {{-- <figure class="image-box">
                    <img src="{{ asset($gallery->thumb) }}" alt="">
                </figure> --}}
                <div class="image-box">
                    <img src="{{ asset($gallery->thumb) }}" alt="">
                </div>
                <div class="view-box d-flex align-items-center flex-column justify-content-center">
                    <a href="{{ asset($gallery->image) }}"
                        class="lightbox-image d-flex justify-content-center align-items-center flex-column"
                        data-fancybox="gallery">
                        <!-- <i class="flaticon-plus-symbol"></i> -->
                        <i class="fa fa-eye"></i>
                        <span class="text-heading text-center">{{ $gallery->title }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
