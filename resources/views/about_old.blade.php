@extends('layouts.master')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">   InFo            </div>
                <div class="card-body">
                    <h1>{{Str::upper($name)}}</h1>
                    <p>students:</p>
                    @foreach ( $students as $student)
                        <li>{{$loop->index+1}}) {{$student}}</li>
                    @endforeach

                    @for ($i=1; $i<=10; $i++)
                        <h2>{{$i}}</h2>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



