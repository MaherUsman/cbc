@foreach($users as $user)
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-profile">
            <div class="card-header justify-content-end pb-0 border-0">
                <div class="dropdown">
                    <button class="btn btn-link" type="button" data-bs-toggle="dropdown">
                        <span class="dropdown-dots fs--1"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right border py-0">
                        <div class="py-2">
{{--                            @dd($users->items())--}}
                            <a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                            <a class="dropdown-item text-danger" href="{{ route('admin.users.destroy', $user->id) }}">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="text-center">
                    <div class="profile-photo">
                        <img src="{{ $user->profile_photo_url }}" width="100" class="img-fluid rounded-circle" alt="">
                    </div>
                    <h3 class="mt-4 mb-1">{{ $user->name }}</h3>
                    <p class="text-muted">{{ $user->email }}</p>
                    <ul class="list-group mb-3 list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="mb-0">{{ __('users.admin.index.created_at') }} :</span><strong>{{ $user->created_at }}</strong></li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="mb-0">{{ __('users.admin.index.email') }} :</span><strong>{{ $user->email }}</strong></li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="mb-0">{{ __('users.admin.index.mobile') }} :</span><strong>{{ $user->mobile }}</strong></li>
                    </ul>
                    </div>
            </div>
        </div>
    </div>
@endforeach
{{ $users->links('vendor.pagination.bootstrap-4') }}

@push('scripts-js')
<script>
    callAjax(
        "",   // URL
        $(elem).attr('data-method'),           // Method
        {key: 'value'}, // Data
        function (response) { // Success callback
            Swal.fire(
                'Deleted!',
                'Your Record has been deleted.',
                'success'
            );
            oTable.ajax.reload()
        },
        function (error) { // Error callback
            Swal.fire(
                'Warning!',
                error,
                'error'
            );

        },
        function () { // Before send callback

        }
    );
</script>
@endpush
