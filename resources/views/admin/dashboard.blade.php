@extends('layouts.admin.index')
@section('content')
    <h4>Welcome To Dashboard</h4>
    <div class="row">
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-primary">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3">
                            <i class="la la-cat"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Total Animals</p>
                            <h3 class="text-white">{{$animals}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-warning">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3">
                            <i class="la la-calendar"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Total Events</p>
                            <h3 class="text-white">{{$events}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-secondary">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3">
                            <i class="la la-images"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Activities</p>
                            <h3 class="text-white">{{$activities}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-danger">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3">
                            <i class="la la-images"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Visitors</p>
                            <h3 class="text-white">{{$visitors}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-success">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3">
                            <i class="la la-users"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Team Members</p>
                            <h3 class="text-white">{{$teams}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
