@extends('admin.admin_master')
@section('admin')

<div class="py-12">
  <div class="container">
    <div class="row">
        <a href="{{ route('add.slider') }}" class="btn btn-info ml-auto m-3">Add Slider</a>

      <div class="col-md-12">
        <div class="card">
          @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif
          <div class="card-header">
            All Sliders
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" width='5%'>SL No.</th>
                  <th scope="col" width='10%'>Slider Title</th>
                  <th scope="col" width='20%'>Slider Description</th>
                  <th scope="col" width='15%'>Slider Image</th>
                  <th scope="col" width='15%'>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($sliders as $slider)
                <tr>
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{ $slider->title }}</td> 
                  <td>{{ $slider->description }}</td>
                  <td><img src="{{ asset($slider->image) }}" style="height: 60px; width: 90px;"></td>
                  <td><a href="{{ url('/edit/slider/'.$slider->id) }}" class="btn btn-info">Edit</a>
                  <a href="{{ url('/delete/slider/'.$slider->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a></td>
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