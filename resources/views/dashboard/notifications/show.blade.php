@extends('layouts.admin')
@section('container')
    <!-- MAIN CONTENT -->
    <section class="content">
        <div class="container-fluid">

            <!-- CUSTOM CONTENT -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header ">
                            <div class="d-flex justify-content-between">
                                <div>{{ $notification->data['title'] }}</div>
                                <div class="text-muted">
                                    <small class="mr-2">
                                        <i class="fas fa-user"></i>
                                        By {{ $notification->data['name'] }}
                                    </small>
                                    <small>
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                        {!! $notification->data['content'] !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CUSTOM CONTENT -->

        </div>
    </section>
    <!-- END CONTENT -->

@endsection
