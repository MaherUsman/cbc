<!-- resources/views/admin/animalGallery/gallery_items.blade.php -->
@foreach($animalGalleries as $gallery)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="gallery-img-wrapper position-relative w-100 h-100">
            <a href="{{asset($gallery->image)}}" data-src="{{asset($gallery->image)}}" class="lg-item">
                <img src="{{asset($gallery->image)}}" class="rounded" alt="" style="width:100%;">
            </a>
            <div class="gallery-overlay rounded">
                <div class="overlay-icons-wrapper w-100 d-flex flex-column align-items-end">
                    <div class="overlay-icon mt-2">
                        <a href="{{ route('animal-galleries.edit', $gallery) }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
{{--                    <div class="overlay-icon mt-2">--}}
{{--                        <a href="#" class="editImage" data-id="{{ $gallery->id }}" data-image="{{ asset($gallery->image) }}">--}}
{{--                            <i class="fa-solid fa-pen-to-square"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                    <div class="overlay-icon mt-2">
                        <a href="#" data-url="{{ route('animal-galleries.destroy', $gallery) }}" title="Delete"
                           class="deleteRecord" data-bs-toggle="tooltip" data-bs-placement="top">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="img-title mt-3">
                    <p>{{ $gallery->title }}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
