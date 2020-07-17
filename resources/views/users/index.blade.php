@extends('layouts.app')
    @push('vendor-styles')
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endpush
@push('other-styles')
@endpush
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">AM</a>
                        </li>
                        <li class="breadcrumb-item">User Management
                        </li>
                        <li class="breadcrumb-item active">Users
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card" id="add-box">
                        <div class="card-header">
                            <h4 class="card-title">Add User</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <form method="POST" action="{{ route('user-management.save_user') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('name') ? ' form-control-warning' : '' }}">
                                                <label for="name">{{ __('Name') }} <span class="required">*</span></label>
                                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

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
                                                <input type="file" class="form-control{{ $errors->has('profile_picture') ? ' is-invalid' : '' }}" name="profile_picture" value="{{ old('profile_picture') }}" required autofocus>

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
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <p class="text-right mb-0">
                                                        <small class="warning text-muted">{{ $errors->first('email') }}</small>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('role') ? ' form-control-warning' : '' }}">
                                                <label for="role">{{ __('Role') }} <span class="required">*</span></label>
                                                <select name="role" required class="form-control">
                                                    <option value="">Select Role</option>
                                                    <option {{(old('role') == 'System Administrator')? 'selected':''}} value="System Administrator">System Administrator</option>
                                                    <option {{(old('role') == 'scribe')? 'selected':''}} value="scribe">Scribe/Meeting Manager</option>
                                                    <option {{(old('role') == 'Participant')? 'selected':''}} value="Participant">Participant</option>
                                                </select>
                                                 @if ($errors->has('role'))
                                                    <p class="text-right mb-0">
                                                        <small class="warning text-muted">{{ $errors->first('role') }}</small>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary mr-2">
                                                {{ __('Add User') }}
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List of Users</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="users-table">
                                    <thead>
                                    <tr>
                                        <th>Profile Picture</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th width="30px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                @isset( $user->profile_picture )
                                                    <img src="{{ asset('/ProfilePictures/'.$user->profile_picture) }}" class="rounded-circle height-50" alt="Card image" id="user_photo" >
                                                @else
                                                    <img src="{{ asset('images/pied-piper48.png') }}" alt="profile picture" class="rounded-circle height-50" id="user_mini_profile">
                                                @endisset
                                                </td>
                                            <td>{{$user->name}}</td>
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->role}}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{route('user-management.user_profile',[\Illuminate\Support\Facades\Crypt::encrypt($user->id)])}}"
                                                       class="btn btn-s btn-dark"><i class="ft-eye"></i></a>
                                                    <a href="#add-box" onclick="edit_user('{{\Illuminate\Support\Facades\Crypt::encrypt($user->id)}}')" class="btn btn-s btn-edit">
                                                        <i class="ft-edit"></i>Edit</a>
                                                    <a href="{{route('user-management.delete_user',[\Illuminate\Support\Facades\Crypt::encrypt($user->id)])}}"
                                                       class="btn btn-s btn-danger" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure you want to delete this user?');"
                                                       title="Delete User"><i class="ft-trash-2"></i></a>
                                                </div>
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
@endsection
@push('vendor-script')
        <script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
@endpush
@push('end-script')
    <script>

        $('#users-table').dataTable( {
            "ordering": false
        } );

        //Script to call the edit view for user
        function edit_user(key) {

            var path = "{{route('user-management.edit_user')}}";
            $.ajaxSetup(    {
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $.ajax({
                url: path,
                type: 'GET',
                data: {id:key},
                beforeSend: function(){
                    $('#add-box').block({
                        message: '<div class="ft-loader icon-spin font-large-1"></div>',
                        overlayCSS: {
                            backgroundColor: '#ccc',
                            opacity: 0.8,
                            cursor: 'wait'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'transparent'
                        }
                    });;
                },
                success: function(data){
                    $('#add-box').empty();
                    $('#add-box').html(data.theView);
                    console.log(data)
                },
                complete:function(){
                    $('#add-box').unblock();
                }
                ,
                error: function (data) {
                    console.log(data)
                }
            });
        }
    </script>
@endpush