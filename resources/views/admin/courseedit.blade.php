@extends('layouts.app')

@section('content')
<h1>Edit Course</h1>
<form method="POST" action="/courses/{{$course->id}}">
    @csrf
    @method("PUT")
    <div class="form-group">
    <input type="text" class="form-control" value="{{$course->name}}" id="name" name="name" class="@error('title') is-invalid @enderror" placeholder="name of the course" >
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <textarea name="description"  id="description" placeholder="Description" style="width: 100%;" class="@error('title') is-invalid @enderror" >{{$course->description}}</textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
      <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection