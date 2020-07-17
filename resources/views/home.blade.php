@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">AM</a>
                        </li>
                        <li class="breadcrumb-item">Dashboard
                        </li>
                        <li class="breadcrumb-item active">Filter/Search
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h3>Search ...</h3>
            </div>
            <!--Search Form-->
            <div class="card-body">
                <div class="search_area" id="search_area">
                    @csrf
                    <fieldset>
                        <div class="input-group">
                            <input type="text" name="search_value"
                                   required class="form-control" placeholder="Search Meeting Minutes" id="search_value" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary square" type="search" onclick="searchMinutes()" ><i class="ft-search"></i> Search</button>
                            </div>
                        </div>
                        @if ($errors->has('search_value'))
                            <p class="text-right">
                                <small class="warning text-muted">{{ $errors->first('search_value') }}</small>
                            </p>
                        @endif
                    </fieldset>
                </div>
            </div>
            <!--/Search Form-->
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Search Results...</h3>
            </div>
            <div class="card-body" id="results_area">
                <hr/>

            </div>
        </div>
    </div>
@endsection
@push('end-script')

<script>
    function searchMinutes() {
        console.log("hello");

        let block_ele = $('#search_area');

        let search_value=$('#search_value').val();

        if(search_value === ""){
            toastr['warning']('Input field for Search is required', 'failed','{positionClass:toast-top-right, "showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 8000}');
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "{{route('minutes.search')}}",
            data: {search_value: search_value},

            beforeSend: function () {

                $(block_ele).block({
                    message: '<span class="semibold"> Please wait...</span>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });

            },

            success: function (data) {

                console.log(data);

                $("#results_area").html(data.the_view);

            },
            complete: function () {
                $(block_ele).unblock();
            },
            error: function (data) {
                console.log(data);
            }
        })
    }
</script>
@endpush
