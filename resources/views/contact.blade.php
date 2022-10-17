@extends('layouts.master')
@section('content')
    <h1>This is my history</h1>
    <div class="Container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        History
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error )
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        @if (session('success_message'))
                            <div class="alert alert-success">
                                {{session('success_message')}}
                            </div>
                        @endif

                        <form action="{{url('contact/post')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" >
                            @error('name')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" >
                                @error('email')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="4">{{old('message')}}</textarea>
                                @error('message')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="Container mt-4" id="contact_2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        History 2
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                          <label for="" class="form-label">Name</label>
                          <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
