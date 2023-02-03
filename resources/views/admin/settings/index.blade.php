@extends('layouts.admin')

@section('container')
    <section class="content">
        <div class="container-fluid">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title"><i class="fas fa-tools mr-2"></i>{{ __('Settings') }}</h5>
                    </div>
                </div>

                <div class="card-body ">

                    <!-- Nav pills -->
                    <ul class="nav nav-tabs">

                        @foreach ($tabListItems as $tabListItem)
                            {!! $tabListItem !!}
                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        @foreach ($tabs as $tab)
                            @include($tab)
                        @endforeach
                    </div>

                </div>
            </div>

        </div>


        <!-- END CUSTOM CONTENT -->

    </section>
    <!-- END CONTENT -->

    <script>
        // Add the following code if you want the name of the file appear on select
        document.addEventListener('DOMContentLoaded', () => {
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                console.log(fileName)
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        })
        const tabPaneHash = window.location.hash;
        console.log(tabPaneHash);
        if (tabPaneHash) {
            $('.nav-tabs a[href="' + tabPaneHash + '"]').tab('show');
        }
        $('.nav-tabs a').click(function(e) {
            $(this).tab('show');
            const scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
        });
    </script>


@endsection