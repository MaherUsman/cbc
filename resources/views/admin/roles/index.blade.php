@extends('layouts.admin.index')
@section('content')
    @include('layouts.admin.includes.breadcrumbs' , ['breadcrumbs' => [['name' => __('roles.admin.breadcrumbs.name') , 'route' => null]],
 'pageTitle' => 'Roles'])

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title">{{ __('roles.admin.index.list_roles') }}</h6>
                        <a href="{{route('admin.roles.create')}}">
                            <button type="button" class="btn btn-primary">{{__('roles.admin.index.add_role')}}</button>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableYajra" class="table">
                            <thead>
                            <tr>
                                <th>{{__('roles.admin.index.name')}}</th>
                                <th>{{__('roles.admin.index.created_at')}}</th>
                                <th>{{__('roles.admin.index.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts-js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initializeDataTable(
                '#dataTableYajra',
                '{{ route("admin.roles.datatable") }}',
                [
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'}
                ]
            );
        });

    </script>
@endpush
