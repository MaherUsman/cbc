@foreach($animals as $animal)
    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
        <div class="gallery-block-one">
            <div class="inner-box">
                <figure class="image-box">
                    <img src="{{ asset($animal->image) }}" alt="" />
                </figure>
                <div class="content-box">
                    <h3><a href="{{ route('frontend.listing.animal', $animal->slug) }}">{{ $animal->title }}</a></h3>
                </div>
                <div class="overlay-content">
                    <h3><a href="{{ route('frontend.listing.animal', $animal->slug) }}">{{ $animal->title }}</a></h3>
                    <div class="link">
                        <a href="{{ route('frontend.listing.animal', $animal->slug) }}"><i class="flaticon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

