@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>Admin Panel</h2>
                    <a href="/courses/create">Create a course.</a>
                    @if ( isset($courses))
                        <h3> Created coures  {{count($courses)}}: </h3>
                        <div class="d-flex flex-row justify-content-around flex-wrap">
                            @foreach ($courses as $course)
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$course->name}}</h5>
                                        <p class="card-text">{{$course->description}}</p>
                                        <div class="d-flex flex-row justify-content-around">
                                            <a href="/courses/{{$course->id}}/edit" class="btn btn-primary">Edit</a>
                                            <form action="/courses/{{$course->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h3>No courses created</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
