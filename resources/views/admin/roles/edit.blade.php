@extends('layouts.admin.index')
@section('content')
    @include('layouts.admin.includes.breadcrumbs', ['breadcrumbs' => [['name' => __('roles.admin.breadcrumbs.name'), 'route' => 'admin.roles.index'],
       ['name' => __('roles.admin.breadcrumbs.edit_role'), 'route' => null]], 'pageTitle' => 'Edit Roles'
    ])

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{ __('roles.admin.edit.edit') }}</h6>
                    <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('roles.admin.create.name') }}<span class="text-danger">*</span></label>
                                <input type="text" data-rule-required="true" data-msg-required="{{ __('roles.admin.create.name_message') }}" name="name" value="{{ old('name', $role->name) }}" class="form-control" placeholder="{{ __('roles.admin.create.name') }}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{ __('roles.admin.create.user_permissions') }}:</h4>
                            </div>
                        </div>
                        <br>
                        @php
                            $sections = [
                                'roles' => ['permissions' => ['view_role', 'add_role', 'edit_role', 'delete_role']],
                                'users' => ['permissions' => ['view_user', 'add_user', 'edit_user', 'delete_user']],
                                'companies' => ['permissions' => ['view_company', 'add_company', 'edit_company', 'delete_company']],
                                'jobs' => ['permissions' => ['view_job', 'add_job', 'edit_job', 'delete_job']],
                                'teachers' => ['permissions' => ['view_teacher', 'add_teacher', 'edit_teacher', 'delete_teacher']],
                                'testimonials' => ['permissions' => ['view_testimonial', 'add_testimonial', 'edit_testimonial', 'delete_testimonial']],
                                'subjects' => ['permissions' => ['view_subject', 'add_subject', 'edit_subject', 'delete_subject']],
                                'plans' => ['permissions' => ['view_plan', 'add_plan', 'edit_plan', 'delete_plan']],
                                'courses' => ['permissions' => ['view_course', 'add_course', 'edit_course', 'delete_course']],
                            ];
                        @endphp
                        @foreach($sections as $section => $details)
                            <div class="row check_group">
                                <div class="col-md-1">
                                    <h4>{{ __('roles.admin.create.'.$section) }}</h4>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="check_all input-icheck select_all" {{ old('select_all_'.$section) ? 'checked' : '' }}> {{ __('roles.admin.create.select_all') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    @foreach($details['permissions'] as $permission)
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{ $section . '.' . $permission }}" class="input-icheck" {{ is_array(old('permissions', $role_permissions)) && in_array($section . '.' . $permission, old('permissions', $role_permissions)) ? 'checked' : '' }}> {{ __('roles.admin.create.' . $permission) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <button type="submit" class="btn btn-primary submit">{{ __('roles.admin.edit.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-js')
    <script>
        $('.select_all').click(function () {
            var isChecked = $(this).prop('checked');
            $(this).closest('.check_group').find('.input-icheck').prop('checked', isChecked);
        });
    </script>
@endpush
