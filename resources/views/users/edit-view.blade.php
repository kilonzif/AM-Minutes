<div class="card-header">
    <h4 class="card-title">Editing User</h4>
    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
    <div class="heading-elements">
        <ul class="list-inline mb-0">
            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
        </ul>
    </div>
</div>
<div class="card-content collapse show">
    <div class="card-body card-dashboard">
        <form method="POST" action="{{ route('user-management.update_user') }}">
            @csrf
            <input type="hidden" name="id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($user->id)}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('name') ? ' form-control-warning' : '' }}">
                        <label for="name">{{ __('Name') }} <span class="required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name')?old('name'):$user->name }}"  required autofocus>

                        @if ($errors->has('name'))
                            <p class="text-right mb-0">
                                <small class="warning text-muted">{{ $errors->first('name') }}</small>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('profile_picture') ? ' form-control-warning' : '' }}">
                        <label for="profile_picture">{{ __('Profile Picture') }} <span class="required">*</span></label>
                        <input type="file" class="form-control{{ $errors->has('profile_picture') ? ' is-invalid' : '' }}"
                               name="profile_picture" value="{{ old('profile_picture')?old('profile_picture'):$user->profile_picture }}" required autofocus>

                        @if ($errors->has('profile_picture'))
                            <p class="text-right mb-0">
                                <small class="warning text-muted">{{ $errors->first('profile_picture') }}</small>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('email') ? ' form-control-warning' : '' }}">
                        <label for="email">{{ __('E-Mail Address') }} <span class="required">*</span></label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               name="email" value="{{ old('email')?old('email'):$user->email }}" required>

                        @if ($errors->has('email'))
                            <p class="text-right mb-0">
                                <small class="warning text-muted">{{ $errors->first('email') }}</small>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has('role') ? ' form-control-warning' : '' }}">
                        <label for="role">{{ __('Role') }} <span class="required">*</span></label>
                        <select name="role" required class="form-control">
                            <option value="">Select Role</option>
                            <option {{($user->role == 'System Administrator')? 'selected': ''}}  value="System Administrator">System Administrator</option>
                            <option {{($user->role == 'scribe')? 'selected': ''}} value="scribe">Scribe/Meeting Manager</option>
                            <option {{($user->role == 'Participant')? 'selected': ''}} value="Participant">Participant</option>
                        </select>
                        @if ($errors->has('role'))
                            <p class="text-right mb-0">
                                <small class="warning text-muted">{{ $errors->first('role') }}</small>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary mr-2">
                        {{ __('Update User') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>