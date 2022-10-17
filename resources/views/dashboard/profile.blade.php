@extends('layouts.app')
@section('content')
<div class="content-body" style="min-height:1116px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
        <div class="row">
            {{--Start Name Change --}}
            <div class="col-lg-12" >
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="" >
                                <img style=" min-height:451px; width:100%;" src="{{asset('uploads/cover_photos')}}/{{auth()->user()->cover_photo}}" alt="not found">
                            </div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="{{asset('uploads/profile_photos')}}/{{auth()->user()->profile_photo}}" class="img-fluid rounded-circle" alt="not found">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{auth()->user()->name}}</h4>
                                    <p>Name</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{auth()->user()->email}}</h4>
                                    <p>Email</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    {{-- <h4 class="text-muted mb-0">{{auth()->user()->created_at->format('d/m/y')}}</h4> --}}
                                    <h4 class="text-muted mb-0">{{auth()->user()->created_at->diffForHumans()}}</h4>
                                    <p>Account created </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" id="name_change">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">Name Change</h4>
                    </div>
                    <div class="card-body">
                        @if (session('name_change_success'))
                            <div class="alert alert-success">
                               {{session('name_change_success')}}
                            </div>
                        @endif
                        <form action="{{url('change/name')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}" >
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-sm btn-success">Name Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--End Name Change --}}
            {{--Start Profile Photo Change --}}
            <div class="col-lg-6" id="profile_photo_change">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">Profile Photo Change</h4>
                    </div>
                    <div class="card-body">
                        @if (session('profile_p_success'))
                            <div class="alert alert-success">
                               {{session('profile_p_success')}}
                            </div>
                        @endif
                        <form action="{{url('change/profile/photo')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo" >
                                @error('profile_photo')
                                    <span class="text-danger"> {{$message}} </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <button class="btn btn-sm btn-success">Profile Photo Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Profile Photo Change --}}
            {{--Start Cover Photo Change --}}
            <div class="col-lg-6" id="c_photo_change">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">Cover Photo Change</h4>
                    </div>
                    <div class="card-body">
                        @if (session('Cover_p_success'))
                            <div class="alert alert-success">
                               {{session('Cover_p_success')}}
                            </div>
                        @endif
                        <form action="{{url('change/cover/photo')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Cover Photo</label>
                                <input type="file" class="form-control @error('cover_photo') is-invalid @enderror" name="cover_photo"  >
                            </div>
                            @error('cover_photo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="mb-3">
                                <button class="btn btn-sm btn-success">Cover Photo Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Cover Photo Change --}}
            <div class="col-lg-12" id="p_change">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">Change Password</h4>
                    </div>
                    <div class="card-body">
                        @if (session('p_success'))
                            <div class="alert alert-success">
                               {{session('p_success')}}
                            </div>
                        @endif
                        @if (session('p_not_match'))
                            <div class="alert alert-danger">
                               {{session('p_not_match')}}
                            </div>
                        @endif
                        <form action="{{url('change/password')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label class="form-label">Current password</label>
                                    <input type="password" class="form-control " name="current_password"  >

                                </div>
                                <div class="mb-3 col-4">
                                    <label class="form-label">New password</label>
                                    <input type="password" class="form-control" name="new_password" >
                                </div>
                                <div class="mb-3 col-4">
                                    <label class="form-label">Confirm password</label>
                                    <input type="password" class="form-control" name="confirm_password"  >
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-sm btn-success">Change password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


