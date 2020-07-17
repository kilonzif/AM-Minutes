@extends('layouts.app')

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">AM</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('user-management.users')}}" >User Management</a>
                    </li>
                    <li class="breadcrumb-item active">User Profile
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-xl-8 vertical-scroll" id="scrolls">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Information</h4>
                    <hr>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div>
                                <div class="col-12" id="image_location">
                                    @isset( $user->profile_picture )
                                        <img src="{{ asset('/ProfilePictures/'. $user->profile_picture) }}" alt="profile picture" class="rounded-circle height-200" id="user_mini_profile">
                                    @else
                                        <img src="{{ asset('images/pied-piper48.png') }}" alt="profile picture" class="rounded-circle height-200" id="user_mini_profile">
                                    @endisset
                                </div>
                            </div>
                            <div class="col-sm-6 pb-2 pl-2">
                                <div class="row">
                                    <div class="col-6 pr-0"><b>Name :</b></div>
                                    <div class="col-6 pl-0">
                                        {{$user->name}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pb-2 pl-2">
                                <div class="row">
                                    <div class="col-6 pr-0"><b>Email Address :</b></div>
                                    <div class="col-6 pl-0">
                                        {{$user->email}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 pb-2 pl-2">
                                <div class="row">
                                    <div class="col-6 pr-0"><b>Role(s) :</b></div>
                                            {{ $user->role }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection