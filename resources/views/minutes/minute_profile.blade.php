@extends('layouts.app')
<style type="text/css">
    table tr th{
        text-align: left !important;
        font-size: 20px;

    }
    td{
        vertical-align: top;
        font-size: 20px;
        padding: 20px;
    }
</style>

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">AM</a>
                        </li>
                        <li class="breadcrumb-item active">View Minutes
                        </li>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="card">
            <div class="pull-right">
                   <a class="btn btn-primary" style="float: right" id="doPrint" onclick="print()" ><i class="ft-printer"></i> Export to PDF</a>
            </div>
            <div class="col-lg-12" id="meeting-profile">
                <div class="col-lg-12">
                     <table class="card-body">
                    <tbody>
                    <tr>
                        <th>Meeting Title: </th>
                         <td>{{empty($this_minute->meeting_title) ? "N/A" : $this_minute->meeting_title}}</td>
                      </tr>
                    <tr>
                        <th>Held on: </th>
                         <td>{{empty($this_minute->start_date) ? "N/A" : $this_minute->start_date}} TO</td>
                        <td>{{empty($this_minute->end_date) ? "N/A" : $this_minute->end_date}}</td>
                      </tr>
                    <tr>
                        <th>Purpose of Meeting: </th>
                         <td>{{empty($this_minute->purpose) ? "N/A" : $this_minute->purpose}}</td>
                      </tr>
                    <tr>
                        <th>Organizers </th>
                         <td>{{empty($this_minute->organization) ? "N/A" : $this_minute->organization}}</td>
                         <td>Secretary: {{empty($organizer->name) ? "N/A" : $organizer->name}}</td>
                      </tr>
                    </tbody>
                </table>
                </div>

                <div class="col-lg-12">
                        <h5 class="card-title" style="font-weight: bold">Meeting Attendants</h5>
                    <hr/>
                        <ol>
                            @foreach($attendants as $attendant)
                            <li>{{$attendant->name}} -{{$attendant->role}} - {{$attendant->email}} </li>
                            @endforeach
                        </ol>
                    <br>
                        <h5 class="card-title" style="font-weight: bold">Meeting Notes</h5>
                        <hr/>

                        {!! $this_minute->meeting_notes !!}

                </div>

            </div>
        </div>


    </div>
@endsection

@push('end-scripts')
    <script>
        function print(){
            alert('clicked');
        }
        document.getElementById("doPrint").addEventListener("click", function() {

            console.log("here");
            var printContents = document.getElementById('meeting-profile').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });
    </script>

@endpush

