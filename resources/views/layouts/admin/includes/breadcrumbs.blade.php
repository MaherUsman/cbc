<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>{{$pageTitle}}</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            @foreach($breadcrumbs as $breadcrumb)
                                @if($breadcrumb['route'] != null)
                                    <li class="breadcrumb-item active"><a href="{{route($breadcrumb['route'])}}">{{$breadcrumb['name']}}</a></li>
                                @else
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{$breadcrumb['name']}}</a></li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
