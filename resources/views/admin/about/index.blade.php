@extends('admin.admin_master')
@section('admin')

<div class="py-12">
  <div class="container">
    <div class="row">
        <a href="{{ route('add.about') }}" class="btn btn-info ml-auto m-3">Add New About</a>

      <div class="col-md-12">
        <div class="card">
          @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif
          <div class="card-header">
            All About Data
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" width='5%'>SL No.</th>
                  <th scope="col" width='10%'>Title</th>
                  <th scope="col" width='20%'>Short Description</th>
                  <th scope="col" width='30%'>Long Description</th>
                  <th scope="col" width='15%'>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($abouts as $about)
                <tr>
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{ $about->title }}</td> 
                  <td>{{ $about->short_des }}</td>
                  <td>{{ $about->long_des }}</td>
                  <td><a href="{{ url('/edit/about/'.$about->id) }}" class="btn btn-info">Edit</a>
                  <a href="{{ url('/delete/about/'.$about->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
     
    </div>
  </div>
</div>
@endsection