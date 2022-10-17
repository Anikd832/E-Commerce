@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                    welcome
                    <p>Id:{{auth()->user()->id}}</p>
                    <p>Name: {{auth()->user()->name}} </p>
                    <p>Email: {{auth()->user()->email}} </p>
                    <p>Created_at: {{auth()->user()->created_at}} </p>
                    {{--{{ __('You are logged in!') }} --}}
                </div>

            </div>
            {{-- <div class="card mt-4">
                <div class="card-header">
                    All Message
                    <button class="btn btn-sm btn-primary" >
                        <span class="badge bg-primary">Total:{{$contacts->count()}}</span>
                    </button>
                    @if (!$contacts->where('status','read')->count()==0)
                        <button class="btn btn-sm btn-info" >
                            <span class="badge bg-info">Readed:{{$contacts->where('status','read')->count()}}</span>
                        </button>
                    @endif
                    @if (!$contacts->where('status','unread')->count()==0)
                        <button class="btn btn-sm btn-warning" >
                            <span class="badge bg-warning">Unread:{{$contacts->where('status','unread')->count()}}</span>
                        </button>
                    @endif
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="message_table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No.</th>
                                    <th scope="col">Sender Name</th>
                                    <th scope="col">Sender Email</th>
                                    <th scope="col">Sender Message</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody> --}}
                                {{-- @foreach ($contacts as $contact )
                                    <tr class="">
                                        <td scope="row">{{$loop->index+1}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->message}}</td>
                                        <td>{{$contact->status}}</td>
                                        <td> --}}
                                            {{-- <a href="{{url('delete/message')}}/{{$contact->id}}"class="btn btn-sm btn-danger">Delete</a> --}}
                                            {{-- <button value="{{url('delete/message')}}/{{$contact->id}}" class="btn btn-sm btn-danger delete_btn">Delete</button>
                                            @if ($contact->status=='unread')
                                                <a href="{{url('read/message')}}/{{$contact->id}}"class="btn btn-sm btn-info">Read</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach --}}
                                {{-- @forelse($contacts as $contact )
                                <tr class="">
                                    <td scope="row">{{$loop->index+1}}</td>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->message}}</td>
                                    <td>{{$contact->status}}</td>
                                    <td>
                                        <button value="{{url('delete/message')}}/{{$contact->id}}" class="btn btn-sm btn-danger delete_btn">Delete</button>
                                        @if ($contact->status=='unread')
                                            <a href="{{url('read/message')}}/{{$contact->id}}"class="btn btn-sm btn-info">Read</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            <tr class="text-center text-danger">
                                <td colspan="50"> <h3>Nothing to show</h3> </td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection


