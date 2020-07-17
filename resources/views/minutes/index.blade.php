@extends('layouts.app')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">AM</a>
                        </li>
                        <li class="breadcrumb-item active">Meeting Minutes
                        </li>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <a href="{{route('minutes.new')}}" class="btn btn-primary mb-1 pull-right"><i class="ft-plus"></i> Create a Minute</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Past Meetings</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered" id="meetings-table">
                                <thead>
                                <tr>
                                    <th width="30px"> #</th>
                                    <th>Meeting Title</th>
                                    <th>Purpose</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Organization</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $count=0;@endphp
                                @foreach($minutes as $minute)
                                    @php $count++; @endphp
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$minute->meeting_title}}</td>
                                        <td>{{$minute->purpose}}</td>
                                        <td>{{$minute->start_date}}</td>
                                        <td>{{$minute->end_date}}</td>
                                        <td>{{$minute->organization}}</td>

                                        <td>
                                            <a href="{{route('minutes.view',[\Illuminate\Support\Facades\Crypt::encrypt($minute->id)])}}" class="btn btn-primary btn-sm btn-flat" style="margin-right: 7px;">
                                                <i class="ft-eye"></i>
                                            </a>
                                            <a href="{{route('minutes.edit',[$minute->id])}}" class="btn btn-primary btn-sm btn-flat" style="margin-right: 7px;">
                                                <i class="ft-edit"></i>
                                            </a>
                                            <a href="{{route('minutes.delete',[$minute->id])}}"
                                               class="btn btn-s btn-danger" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure you want to delete this Meeting and Its Minutes?');"
                                               title="Delete Minute"><i class="ft-trash-2"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('vendor-script')
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
@endpush
@push('end-script')
    <script>
        $('#meetings-table').dataTable( {
            "ordering": false
        } );
    </script>
@endpush