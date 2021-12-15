@extends('admin.admin_master')
@section('admin')

  <div class="py-12">
    <div class="container">
      <div class="row">

        <div class="col-md-8">
          <div class="card-group">
            @foreach($images as $img)
            <div class="col-md-3 m-2">
              <div class="card">
                <img src="{{ asset($img->image) }}">
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">

            <div class="card-header">
              Multi Image
            </div>
            <div class="card-body">
              <form action="{{ route('store.images') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                  <label for="images" class="form-label">Select Images</label>
                  <input type="file" name="images[]" class="form-control" id="images" multiple>
                  @error('images')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Images</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>

    
  </div>
  @endsection