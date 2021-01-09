@extends('welcome')
@section('content')
<div class="container">
	<a href="{{ route('all.post') }}" class="btn btn-info">All Post</a>

        <div>

            <p>Name : {{ $post->name }}</p>
            <h3>{{ $post->title }}</h3>
            <img src="{{ URL::to($post->image) }}" height="340px;">
            <p>{{ $post->details }}</p>

        </div>

</div>

@endsection
