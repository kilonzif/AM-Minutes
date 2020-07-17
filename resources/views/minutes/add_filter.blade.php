    <div id="filter-{{$filtercount}}" class="col-lg-12" style="display: inline-flex">
    <div class="col-5">
        <div class="accordion-icon-rotate left" role="tabpanel">
        <div class="form-group">
            <label for="filter-by">Filter By</label>
            <select class="form-control select-lg filter_select_{{$filtercount}}" onchange="filterselect('filter_select_{{$filtercount}}','{{$filtercount}}')" name="filter_by[]" id="filter_by">
            <option  value="">select one</option>
                <option  value="date">The date of the Meeting</option>
                <option value="organization"> The name of the organization</option>
                <option  value="purpose">The purpose of the meeting</option>
                <option value="participants" >The people in attendance</option>
            </select>
        </div>
        </div>
    </div>
    <div class="col-5">
        <div class="accordion-icon-rotate left" role="tabpanel" id="filterbydate{{$filtercount}}"   style="display:none"  >
            <div role="tabpanel" aria-labelledby="filterbydate" aria-expanded="false">
                <div class="card-content">
                    <div class="form-group">
                        <label for="filterbydate">Start Date(Time) or End Date(Time)</label>
                        <input type="datetime-local" class="form-control"  name="date" id="filterbydate">
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-icon-rotate left" role="tabpanel" id="filterbyorganization{{$filtercount}}"  style="display:none" >
            <div role="tabpanel" aria-labelledby="filterbyorganization" aria-expanded="false">
                <div class="card-content">
                    <div class="form-group">
                        <label for="start_date">Name of Organization</label>
                        <input type="text" class="form-control"  name="organization" id="filterbyorganization">
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-icon-rotate left" role="tabpanel" id="filterbypurpose{{$filtercount}}"  style="display:none">
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
        <div class="accordion-icon-rotate left" role="tabpanel" id="filterbyparticipants{{$filtercount}}"  style="display:none" >
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

        <div class="col-md-2">
          <span style="float: left!important;margin-top: 42px">
              <button type="button" onclick="removefilter('filter-{{$filtercount}}')" class="btn btn-md btn-danger"><i class="fa fa-close"></i> </button>
           </span>
        </div>
</div>