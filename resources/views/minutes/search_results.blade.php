

<div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#Meeting Title</th>
                <th scope="col">Puropose</th>
                <th scope="col">Start - End Date</th>
                <th scope="col">Organization</th>
                <th scope="col">More ...</th>
            </tr>
            </thead>
            <tbody>
        <tbody>
        @foreach($minutes as $minute)
            <tr>
                <td>{{$minute->meeting_title}}</td>
                <td>{{$minute->purpose}}</td>
                <td>{{$minute->start_date}} - {{$minute->end_date}}</td>
                <td>{{$minute->organization}}</td>
                <td>
                    <a href="{{route('minutes.view',[\Illuminate\Support\Facades\Crypt::encrypt($minute->id)])}}" class="btn btn-primary btn-sm btn-flat" style="margin-right: 7px;">
                        <i class="ft-eye"></i>
                    </a>
                </td>
            </tr>

        @endforeach

        </tbody>


    </table>
</div>