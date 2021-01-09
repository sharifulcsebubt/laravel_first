@extends('welcome')
@section('content')
<div class="container">

        <a href="{{ route('add.category') }}" class="btn btn-danger">Add Category</a>
        <a href="{{ route('all.category') }}" class="btn btn-info">All Category</a>

        <hr>

        <table class="table table-responsive">
          <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Address</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
          @foreach($category as $row)
          <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->address }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
              <a href="{{ URL::to('edit/category/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
              <a href="{{ URL::to('delete/category/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
              <a href="{{ URL::to('view/category/'.$row->id) }}" class="btn btn-sm btn-success">View</a>
            </td>
          </tr>
          @endforeach
        </table>


</div>

@endsection
