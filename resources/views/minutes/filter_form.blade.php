@extends('layouts.app')
@push('other-styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <style type="text/css">
        /*.dropdown-toggle{*/
            /*height: 40px;*/
            /*width: 1100px !important;*/
        /*}*/
    </style>

@endpush
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Filter
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="card">
            <div class="row">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="get" action="{{route('minutes.filter_minutes')}}">
                                <div class="form-group row">
                                    @php  $filtercount = 111 ;@endphp
                                    @if(request()->query->has('filter_by'))
                                        @foreach(request()->query->get('filter_by') as $mainkey => $filter_by)
                                                <div id="filter-{{$filtercount}}" class="col-lg-12" style="display: inline-flex">
                                                <div class="col-5">
                                                    <div class="accordion-icon-rotate left" role="tabpanel">
                                                    <div class="form-group">
                                                        <label for="filter-by">Filter By</label>
                                                        <select class="form-control select-lg filter_select_{{$filtercount}}" onchange="filterselect('filter_select_{{$filtercount}}','{{$filtercount}}')" name="filter_by[]" id="filter_by">
                                                            <option  value="">select one</option>
                                                            <option {{$filter_by == "date" ? "selected": "" }}  value="date">The date of the Meeting</option>
                                                            <option {{$filter_by == "organization" ? "selected": "" }} value="organization"> The name of the organization</option>
                                                            <option {{$filter_by == "purpose" ? "selected": "" }} value="purpose">The purpose of the meeting</option>
                                                            <option {{$filter_by == "participants" ? "selected": "" }} value="participants" >The people in attendance</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="accordion-icon-rotate left" role="tabpanel" id="filterbydate{{$filtercount}}"  @if($filter_by == 'date') @else style="display:none" @endif >
                                                        <div role="tabpanel" aria-labelledby="filterbydate" aria-expanded="false">
                                                            <div class="card-content">
                                                                <div class="form-group">
                                                                    <label for="filterbydate">Start Date(Time) or End Date(Time)</label>
                                                                    <input type="datetime-local" class="form-control"  name="date" id="filterbydate">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-icon-rotate left" role="tabpanel" id="filterbyorganization{{$filtercount}}"  @if($filter_by == 'organization') @else style="display:none" @endif >
                                                        <div role="tabpanel" aria-labelledby="filterbyorganization" aria-expanded="false">
                                                            <div class="card-content">
                                                                <div class="form-group">
                                                                    <label for="start_date">Name of Organization</label>
                                                                    <input type="text" class="form-control"  name="organization" id="filterbyorganization">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-icon-rotate left" role="tabpanel" id="filterbypurpose{{$filtercount}}"  @if($filter_by == 'purpose') @else style="display:none" @endif >
                                                        <div role="tabpanel" aria-labelledby="filterbypurpose" aria-expanded="false">
                                                            <div class="card-content">
                                                                <div class="form-group">
                                                                    <label for="filterbypurpose">Purpose of the Meeting</label>
                                                                    <select class="form-control"  name="purpose" id="filterbypurpose">
                                                                        <option value="" >Select One</option>
                                                                        <option {{(old('purpose') == 'annual review')? 'selected':''}} value="annual review" >annual review</option>
                                                                        <option {{(old('purpose') == 'budget planning session')? 'selected':''}} value="budget planning session" >budget planning session,</option>
                                                                        <option {{(old('purpose') == 'nomination of new members')? 'selected':''}} value="nomination of new members" >nomination of new members)</option>
                                                                        <option {{(old('purpose') == 'Orientation')? 'selected':''}} value="Orientation" >Orientation</option>
                                                                        <option {{(old('purpose') == 'Project Meeting')? 'selected':''}} value="Project Meeting" >Project Meeting</option>
                                                                        <option {{(old('purpose') == 'Departmental Meeting')? 'selected':''}} value="Departmental Meeting" >Departmental Meeting</option>
                                                                        <option {{(old('purpose') == 'General Meeting')? 'selected':''}} value="General Meeting" >General Meeting</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-icon-rotate left" role="tabpanel" id="filterbyparticipants{{$filtercount}}"  @if($filter_by == 'participants') @else style="display:none" @endif >
                                                        <div role="tabpanel" aria-labelledby="filterbyparticipants" aria-expanded="false">
                                                            <div class="card-content">
                                                        <div class="form-group">
                                                            <label for="participants">Meeting Attendants</label><br>
                                                            <select class="selectpicker" multiple data-live-search="true" name="participants[]" id="filterbyparticipants">
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}" >{{$user->name}} - {{$user->email}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($mainkey == '0')
                                                    <div class="col-md-1">
                                  <span style="float: left!important;margin-top: 42px">
                                       <button type="button" onclick="addfilter()" class="btn btn-md btn-success"><i class="fa fa-plus"></i> </button>
                                   </span>
                                                    </div>
                                                @else
                                                    <div class="col-md-1">
                                    <span style="float: left!important;margin-top: 42px">
                                        <button type="button" onclick="removefilter('filter-{{$filtercount}}')" class="btn btn-md btn-danger"><i class="fa fa-close"></i> </button>
                                     </span>
                                                    </div>
                                                @endif
                                            </div>
                                            @php $filtercount++; @endphp
                                        @endforeach
                                    @else
                                        <div class="col-lg-12" style="display: inline-flex">
                                            <div class="col-5">
                                                <div class="accordion-icon-rotate left" role="tabpanel">
                                                    <div class="form-group">
                                                        <label for="filter-by">Filter By</label>
                                                        <select class="form-control select-lg filter_select" onchange="filterselect('filter_select')" name="filter_by[]" id="filter_by">
                                                            <option value="">Select One Filter</option>
                                                            <option  value="date">The date of the Meeting</option>
                                                            <option  value="organization"> The name of the organization</option>
                                                            <option value="purpose">The purpose of the meeting</option>
                                                            <option value="participants" >The people in attendance</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="accordion-icon-rotate left" role="tabpanel" id="filterbydate" style="display:none" >
                                                    <div role="tabpanel" aria-labelledby="filterbydate" aria-expanded="false">
                                                        <div class="card-content">
                                                            <div class="form-group">
                                                                <label for="filterbydate">Start Date(Time) or End Date(Time)</label>
                                                                <input type="datetime-local" class="form-control"  name="date" id="filterbydate">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-icon-rotate left" role="tabpanel" id="filterbyorganization" style="display:none"  >
                                                    <div role="tabpanel" aria-labelledby="filterbyorganization" aria-expanded="false">
                                                        <div class="card-content">
                                                            <div class="form-group">
                                                                <label for="start_date">Filter By Organization</label>
                                                                <input type="text" class="form-control"  name="organization" id="filterbyorganization">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-icon-rotate left" role="tabpanel" id="filterbypurpose" style="display:none"  >
                                                    <div role="tabpanel" aria-labelledby="filterbypurpose" aria-expanded="false">
                                                        <div class="card-content">
                                                            <div class="form-group">
                                                                <label for="filterbypurpose">Filter By Purpose of the Meeting</label>
                                                                <select class="form-control"  name="purpose" id="filterbypurpose">
                                                                    <option value="" >Select One</option>
                                                                    <option {{(old('purpose') == 'annual review')? 'selected':''}} value="annual review" >annual review</option>
                                                                    <option {{(old('purpose') == 'budget planning session')? 'selected':''}} value="budget planning session" >budget planning session,</option>
                                                                    <option {{(old('purpose') == 'nomination of new members')? 'selected':''}} value="nomination of new members" >nomination of new members)</option>
                                                                    <option {{(old('purpose') == 'Orientation')? 'selected':''}} value="Orientation" >Orientation</option>
                                                                    <option {{(old('purpose') == 'Project Meeting')? 'selected':''}} value="Project Meeting" >Project Meeting</option>
                                                                    <option {{(old('purpose') == 'Departmental Meeting')? 'selected':''}} value="Departmental Meeting" >Departmental Meeting</option>
                                                                    <option {{(old('purpose') == 'General Meeting')? 'selected':''}} value="General Meeting" >General Meeting</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-icon-rotate left" role="tabpanel" id="filterbyparticipants" style="display:none"  >
                                                    <div role="tabpanel" aria-labelledby="filterbyparticipants" aria-expanded="false">
                                                        <div class="card-content">
                                                    <div class="form-group">
                                                        <label for="participants">Meeting Attendants</label><br>
                                                        <select class="selectpicker" multiple data-live-search="true" name="participants[]" id="filterbyparticipants">
                                                            @foreach($users as $user)
                                                                <option value="{{$user->id}}" >{{$user->name}} - {{$user->email}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                        <span style="float: left!important;margin-top: 42px">
                                            <button type="button" onclick="addfilter()" class="btn btn-md btn-success"><i class="fa fa-plus"></i> </button>
                                        </span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="new-filter col-lg-12">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-5">
                                        <button type="submit" name="generate_report" class="btn btn-primary block-custom-message" style="margin-top: 25px;"
                                        >Filter Minutes <i class="ft-filter"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>

            @if(isset($request) && $request->query->has('generate_report'))
                @yield('minutes.search_results')
            @endif

        </div>
        @if(isset($minutes) && !empty($minutes))
            <div class="card">
                <div class="card-header">
                    <h3>Filter Results...</h3>
                </div>
                <div class="card-body">
                    @include('minutes.search_results')
                </div>
            </div>
        @endif
    </div>

@endsection

@push('end-script')
    <script>

        function filterselect(target,counter) {
            if(typeof counter === "undefined" || counter === null){
                counter = "";
            }

            if ($('.' + target).val() != '') {
                var filter = $('.' + target).val();
                if (filter == 'date') {
                    $("#filterbydate"+counter).css('display', 'block');
                    $("#filterbypurpose"+counter).css('display', 'none');
                    $("#filterbyorganization"+counter).css('display', 'none');
                    $("#filterbyparticipants"+counter).css('display', 'none');

                }
                if (filter == 'purpose') {
                    $("#filterbypurpose"+counter).css('display', 'block');
                    $("#filterbydate"+counter).css('display', 'none');
                    $("#filterbyorganization"+counter).css('display', 'none');
                    $("#filterbyparticipants"+counter).css('display', 'none');

                }
                if (filter == 'organization') {
                    $("#filterbyorganization"+counter).css('display', 'block');
                    $("#filterbydate"+counter).css('display', 'none');
                    $("#filterbypurpose"+counter).css('display', 'none');
                    $("#filterbyparticipants"+counter).css('display', 'none');
                }
                if (filter == 'participants') {
                    $("#filterbyparticipants"+counter).css('display', 'block');
                    $("#filterbyorganization"+counter).css('display', 'none');
                    $("#filterbydate"+counter).css('display', 'none');
                    $("#filterbypurpose"+counter).css('display', 'none');
                }
            }
        }

        function addfilter() {
            $.ajax({
                url: "{{route('minutes.add_filter')}}",
                type: 'post',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function (data) {
                    $('.new-filter').append(data);
                }
            });
        }

        function removefilter(filterid) {
            $('#'+filterid).remove();
        }
    </script>
@endpush