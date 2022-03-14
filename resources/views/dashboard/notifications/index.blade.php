@extends('layouts.admin')
@section('container')
<!-- MAIN CONTENT -->
    <section class="content">
        <div class="container-fluid">

            <!-- CUSTOM CONTENT -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p>{{__('All Aotifications')}}</p>
                </div>
                @foreach($notifications as $notification)
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a {{$notification->read() ? 'class=link-muted' : ''}} href="{{route('dashboard.notification.show' , $notification->id)}}"><i class="fas fa-envelope mr-2"></i>{{ $notification->data['title'] }}</a>
                                    </div>
                                    <div class="text-muted">
                                        <small>
                                            <i class="fas fa-paper-plane mr-2"></i>{{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-md-8">
                    <div class="float-right">
                        {!!  $notifications->links() !!}
                    </div>
                </div>
            </div>

            <!-- END CUSTOM CONTENT -->


        </div>
    </section>
    <!-- END CONTENT -->

@endsection
