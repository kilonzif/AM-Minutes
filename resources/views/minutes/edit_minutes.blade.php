@extends('layouts.app')
@push('end-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endpush
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('minutes.index')}}">Minutes</a>
                        </li>
                        <li class="breadcrumb-item active">Edit a Meeting Minutes
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header" style="border-bottom: 1px solid #4a8ccb47">Edit Minutes</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('minutes.update') }}">
                        @csrf
                        <input type="hidden" value="{{$organizer_id}}" name="organizer_id">
                        <input type="hidden" value="{{$this_minute->id}}" name="minute_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meeting_title">{{ __('Meeting Title') }}</label>

                                    <div>
                                        <input id="meeting_title" type="text" class="form-control{{ $errors->has('meeting_title') ? ' is-invalid' : '' }}"
                                               name="meeting_title" value="{{ old('meeting_title')?old('meeting_title'):$this_minute->meeting_title }}" required autofocus>

                                        @if ($errors->has('meeting_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('meeting_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose">Purpose of the Meeting</label>
                                    <select class="form-control"  name="purpose" id="purpose">
                                        <option value="" >Select One</option>
                                        <option {{($this_minute->purpose == 'annual review')? 'selected': ''}} value="annual review" >annual review</option>
                                        <option {{($this_minute->purpose == 'budget planning session')? 'selected': ''}}  value="budget planning session" >budget planning session,</option>
                                        <option {{($this_minute->purpose == 'nomination of new members')? 'selected': ''}} value="nomination of new members" >nomination of new members)</option>
                                        <option {{($this_minute->purpose == 'Orientation')? 'selected': ''}} value="Orientation" >Orientation</option>
                                        <option {{($this_minute->purpose == 'Project Meeting')? 'selected': ''}} value="Project Meeting" >Project Meeting</option>
                                        <option {{($this_minute->purpose == 'Departmental Meeting')? 'selected': ''}} value="Departmental Meeting" >Departmental Meeting</option>
                                        <option {{($this_minute->purpose == 'General Meeting')? 'selected': ''}} value="General Meeting" >General Meeting</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Name of Organization</label>
                                    <input type="text" class="form-control"  name="organization" id="organization"
                                           value="{{ old('organization')?old('organization'):$this_minute->organization }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date and Time</label>
                                    <input type="datetime-local" class="form-control"  name="start_date" id="start_date"
                                           value="{{ old('start_date')?old('start_date'):$this_minute->start_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date and Time</label>
                                    <input type="datetime-local" class="form-control"  name="end_date" id="end_date"
                                           value="{{ old('end_date')?old('end_date'):$this_minute->end_date }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Add Participants</label>
                                <hr/>


                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ __('Meeting Notes') }}</label>
                                    <div>
                                    <textarea name="meeting_notes"  id="editor1" cols="30" rows="7"
                                              class="textarea form-control{{ $errors->has('meeting_notes') ? ' is-invalid' : '' }}">"{{ old('meeting_notes')?old('meeting_notes'):$this_minute->meeting_notes }}"</textarea>
                                        <script src="{{asset('ckeditor/ckeditor.js')}}" type="text/javascript"></script>
                                        @if ($errors->has('meeting_notes'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meeting_notes') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="">
                                        <button type="submit" class="btn btn-success mr-2">
                                            {{ __('Update') }}
                                        </button>
                                        <a href="{{route('minutes.index')}}" class="btn btn-secondary left">
                                            {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('end-script')
    {{--<script src="{{asset('ckeditor/ckeditor.js')}}" type="text/javascript"></script>--}}
    <script src="{{asset('wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
    <script>
        $(function () {
            CKEDITOR.replace('editor1');
        });
    </script>
@endpush
