@extends('welcome')
@section('content')
<div class="container">

        <a href="{{ route('add.category') }}" class="btn btn-danger">Add Category</a>
        <a href="{{ route('all.category') }}" class="btn btn-info">All Category</a>

        <hr>
        <div>
          <ol>
            <li>Name:{{ $cat->name }}</li>
            <li>Address:{{ $cat->address }}</li>
            <li>Created At:{{ $cat->created_at }}</li>
          </ol>
        </div>

</div>

@endsection
