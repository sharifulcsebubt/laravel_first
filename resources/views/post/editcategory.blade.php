@extends('welcome')
@section('content')
<div class="container">

        <a href="{{ route('add.category') }}" class="btn btn-danger">Add Category</a>
        <a href="{{ route('all.category') }}" class="btn btn-info">All Category</a>

        <hr>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  <form action="{{ url('update/category/'.$category->id) }}" method="post">
    @csrf
          <div class="control-group">
            <div class="form-group ">
              <label>Name</label>
              <input type="text" class="form-control" value="{{ $category->name }}" name="name"  >
            </div>
          </div>

          <div class="control-group">
            <div class="form-group col-xs-12 ">
              <label>Address</label>
              <input type="text" class="form-control" value="{{ $category->address }}" name="address"  >
            </div>
          </div>

          <br>

        <div class="control-group">
            <button type="submit" class="btn btn-primary" >Update</button>
         </div>
    </form>
</div>

@endsection
