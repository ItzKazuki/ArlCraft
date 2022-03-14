@extends('layouts.admin')
@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Send Notifications</h1>
</div>

@if (session()->has('success'))
    <div class="card mb-3 border-left-success">
        <div class="card-body">
            {{ session('success') }}
        </div>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('notifications.post')}}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label>{{__('Users')}}</label><br>
                            <input id="all" name="all"
                                type="checkbox" value="1"
                                onchange="toggleClass('users-form', 'd-none')">
                        <label for="all">{{__('All')}}</label>
                            <div id="users-form">
                                <select id="users" name="users[]" class="form-control" multiple></select>
                            </div>
                            @error('all')
                                <div class="invalid-feedback d-block">
                                    {{$message}}
                                </div>
                            @enderror
                            @error('users')
                                <div class="invalid-feedback d-block">
                                    {{$message}}
                                </div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('Send via')}}</label><br>
                            <input value="database" id="database" name="via[]"
                                type="checkbox">
                            <label for="database">{{__('Database')}}</label>
                        <br>
                            <input value="mail" id="mail" name="via[]"
                                type="checkbox">
                            <label for="mail">{{__('Email')}}</label>
                            @error('via')
                                <div class="invalid-feedback d-block">
                                    {{$message}}
                                </div>
                            @enderror
                    </div>

                    <div class="form-group" >
                        <label for="title">{{__('Title')}}</label>
                            <input value="{{old('title')}}" id="title" name="title"
                                type="text"
                                class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="isi">{{__('content')}}</label>
                            <textarea id="isi"
                                    name="content"
                                    type="content"
                                    class="form-control @error('content') is-invalid @enderror">
                                {{old('content')}}
                            </textarea>
                            @error('content')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Summernote
        $('#isi').summernote({
            height: 100,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        })
        function initUserSelect(data) {
            $('#users').select2({
                ajax: {
                    url: '/admin/users.json',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            filter: { email: params.term },
                            page: params.page,
                        };
                    },
                    processResults: function (data, params) {
                        return { results: data };
                    },
                    cache: true,
                },
                data: data,
                minimumInputLength: 2,
                templateResult: function (data) {
                    if (data.loading) return data.text;
                    const $container = $(
                        "<div class='select2-result-users clearfix' style='display:flex;'>" +
                            "<div class='select2-result-users__avatar' style='display:flex;align-items:center;'><img class='img-circle img-bordered-s' src='" + data.avatarUrl + "?s=40' /></div>" +
                            "<div class='select2-result-users__meta' style='margin-left:10px'>" +
                                "<div class='select2-result-users__username' style='font-size:16px;'></div>" +
                                "<div class='select2-result-users__email' style='font-size=13px;'></div>" +
                            "</div>" +
                        "</div>"
                    );
                    $container.find(".select2-result-users__username").text(data.name);
                    $container.find(".select2-result-users__email").text(data.email);
                    return $container;
                },
                templateSelection: function (data) {
                        $container = $('<div> \
                                        <span> \
                                            <img class="img-rounded img-bordered-xs" src="' + data.avatarUrl + '?s=120" style="height:24px;margin-top:-4px;" alt="User Image"> \
                                        </span> \
                                        <span class="select2-selection-users__username" style="padding-left:10px;padding-right:10px;"></span> \
                                    </div>');
                        $container.find(".select2-selection-users__username").text(data.name);
                        return $container;
                    }
                })
            }
            initUserSelect()
        })
    function toggleClass(id, className) {
        document.getElementById(id).classList.toggle(className)
    }
</script>
@endsection