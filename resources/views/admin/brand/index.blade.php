@extends('admin.admin_master')
@section('admin')

<div class="py-12">
  <div class="container">
    <div class="row">

      <div class="col-md-8">
        <div class="card">
          @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif
          <div class="card-header">
            All Brands
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">SL No.</th>
                  <th scope="col">Brand Name</th>
                  <th scope="col">Brand Image</th>
                  <th scope="col">Created at</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($brands as $brand)
                <tr>
                  <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                  <td>{{ $brand->brand_name }}</td>
                  <td><img src="{{ asset($brand->brand_image) }}" style="height: 40px; width: 70px;"></td>
                  <td>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                  <td><a href="{{ url('/brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a></td>
                  <td><a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $brands->links() }}
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">

          <div class="card-header">
            Add Brand
          </div>
          <div class="card-body">
            <form action="{{ route('add.brand') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="brand_name" class="form-label">brand Name</label>
                <input type="text" name="brand_name" class="form-control" id="brand_name">
                @error('brand_name')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="brand_image" class="form-label">brand image</label>
                <input type="file" name="brand_image" class="form-control" id="brand_image">
                @error('brand_image')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Add Brand</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection